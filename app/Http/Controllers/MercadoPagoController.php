<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use MercadoPago\SDK;
use MercadoPago\Plan;
use MercadoPago\Invoice;
use MercadoPago\Payment;
use Illuminate\Http\Request;
use MercadoPago\Subscription;
use Illuminate\Support\Facades\DB;

class MercadoPagoController extends Controller
{

    public function success()
    {
        return redirect()->route('cart')->with('success', '¡Se ha realizado tu compra! Podrás ver las fotos compradas en la sección de Mis fotos.');
    }

    public function failure()
    {
        return redirect()->route('cart')->withErrors(['¡No se ha realizado tu compra! Intentalo de nuevo más tarde y verifica tu medio de pago.']);
    }

    public function webhook()
    {
        /*Retornar estado 200 o 201*/
        header("HTTP/1.1 200 OK");
        #ob_flush();
        flush();

        SDK::setAccessToken(config('mercadopago.mp_access_token'));

        $payment = "";

        $postData = json_decode(file_get_contents('php://input'), true); // Convert JSON/POST to Array/POST

        if (!isset($postData['type'])) {
            exit();
        }

        switch($postData['type']) {
            case "payment":
                $payment = Payment::find_by_id($postData['data']['id']);
                break;
            case "plan":
                $payment = Plan::find_by_id($postData['data']['id']);
                break;
            case "subscription":
                $payment = Subscription::find_by_id($postData['data']['id']);
                break;
            case "invoice":
                $payment = Invoice::find_by_id($postData['data']['id']);
                break;
        }

        if ($payment->status == "approved") {
            $referenceData = json_decode($payment->external_reference);

            $cart = Cart::where('id', $referenceData->cart_id)->first();

            if (!empty($cart) && $cart->user_id === $referenceData->user_id) {
                $photosId = CartDetail::where('cart_id', $cart->id)->get('photo_id');
                $photos = DB::table('photos')->whereIn('id', $photosId)->get(['id' ,'user_id', 'original_image', 'modified_image', 'price']);

                foreach ($photos as $photo) {
                    $extensionModifiedImage = pathinfo($photo->modified_image, PATHINFO_EXTENSION);
                    $modifiedImageName = $referenceData->user_id.'_'.(time()*rand(1, 4)+rand(0, 50000)).'_'.time().'.'.$extensionModifiedImage;

                    $extensionOriginalImage = pathinfo($photo->original_image, PATHINFO_EXTENSION);
                    $originalImageName = $referenceData->user_id.'_'.(time()*rand(1, 4)+rand(0, 50000)).'_'.time().'.'.$extensionOriginalImage;

                    DB::table('purchased_photos')->insert(
                        [
                            'user_id' => $referenceData->user_id,
                            'payment_id' => $postData['data']['id'],
                            'original_image' => $originalImageName,
                            'modified_image' => $modifiedImageName,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s"),
                        ]
                    );

                    copy(storage_path('app/public/albums_photos/').$photo->modified_image, storage_path('app/public/purchased_photos_thumbnails/').$modifiedImageName);
                    copy(storage_path('app/private/photos/').$photo->original_image, storage_path('app/private/purchased_photos/').$originalImageName);

                    //Set balance per photo after discounts
                    $photo_final_price = (($photo->price)*0.9) - 2; //6% Picwas + 1 + 4% MercadoPago + 1

                    DB::table('users')->where('id', $photo->user_id)->increment('balance', $photo_final_price);
                    // DB::table('users')->where('id', $photo->user_id)->increment('balance', (config("app.price_per_photo") * config("app.percentage_for_the_photographer")));

                    //Delete photo from Album
                    DB::table('albums_photos')->where('id', $photo->id)->delete();
                }

                DB::table('cart_details')->where('cart_id', $referenceData->cart_id)->delete();
                $cart->delete();
            }
        }

        // Objeto payment: https://www.mercadopago.com.pe/developers/es/reference/payments/resource/
    }
}
