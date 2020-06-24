<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Album;
use App\AlbumPhoto;
use App\CartDetail;
use MercadoPago\SDK;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use Illuminate\Http\Request;
use MercadoPago\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CartController extends Controller
{

    /*
    Necesario ingresar con ngrok activo, de lo contrario presenta errores con todas las urls, por ejemplo back_urls y notification_url, ya que no acepta url locales
    */
    public function show()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartDetail = "";
        $initPoint = "";

        if ($cart) {
            $cartDetailToVerify = CartDetail::where('cart_id', $cart->id)->get();

            foreach ($cartDetailToVerify as $detail) {
                $album = DB::table('albums')->where('id', $detail->album_id)->first();
                $photo = DB::table('photos')->where('id', $detail->photo_id)->first();

                if (empty($album) || empty($photo) || $album->publication_time < date('Y-m-d')) {
                    $cart->total -= config('app.price_per_photo');
                    $cart->items -= 1;
                    $cart->save();

                    $detail->delete();

                    if ($cart->items == 0) {
                        $cart->delete();
                    }
                }
            }

            $cart = Cart::where('user_id', Auth::user()->id)->first();

            if ($cart) {
                $cartDetail = CartDetail::where('cart_id', $cart->id)->orderBy('created_at', 'desc')->paginate(12);

                # Mercadopago
                SDK::setAccessToken(config('mercadopago.mp_access_token'));

                # Create a preference object
                $preference = new Preference();

                # Create an item object
                $item = new Item();
                $item->id = $cart->id;
                $item->title = config('app.name')." - Fotos";
                $item->description = "Colección de fotos buscadas en ".config('app.name');
                $item->category_id = "virtual_goods";
                $item->quantity = $cart->items;
                $item->currency_id = config('app.currency');
                $item->unit_price = config('app.price_per_photo');

                # Create a payer object
                $payer = new Payer();
                $payer->name = Auth::user()->first_name;
                $payer->surname = Auth::user()->last_name;;
                $payer->email = Auth::user()->email;
                $payer->identification = array(
                    "type"=>Auth::user()->identification_type,
                    "number"=>Auth::user()->identification_number
                );
                $payer->phone = array(
                    "area_code" => "",
                    "number" => Auth::user()->phone_number
                );
                $payer->address = array(
                    "street_name" => Auth::user()->street_name,
                    "street_number" => Auth::user()->street_number,
                    "zip_code" => Auth::user()->zip_code
                );

                # Payment methods
                $paymentMethod = new PaymentMethod();
                $paymentMethod->installments = 1;
                $paymentMethod->excluded_payment_types = array(
                    array("id" => "ticket"),
                    array("id" => "atm"),
                );

                # Setting preference properties
                $preference->items = array($item);
                $preference->payer = $payer;
                $preference->payment_methods = $paymentMethod;

                $preference->back_urls = array(
                    "success" => route('mp.success'),
                    "failure" => route('mp.failure'),
                    "pending" => route('cart')
                );
                $preference->auto_return = "approved";
                $preference->binary_mode = true;
                $preference->external_reference = json_encode(array('user_id'=>Auth::user()->id, 'cart_id'=>$cart->id));
                $preference->notification_url = route('mp.webhook');

                # Save and posting preference
                $preference->save();

                $initPoint = $preference->init_point;
            }
        }

        return view('cart.show', compact(['cart', 'cartDetail', 'initPoint']));
    }

    public function addPhotoOld(Request $request)
    {
        /*
        Return status
        Success - 0
        Already exists - 1
        Photo unavailable - 2
        */

        if (Album::findOrFail($request->album)->publication_time < date('Y-m-d'))
            return json_encode(['status' => 2]);

        $cart = Cart::class;
        $cartDetail = CartDetail::class;

        if (Cart::where('user_id', Auth::user()->id)->first() === null)
        {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->items = 1;
            $cart->total = config('app.price_per_photo');
            $cart->save();

            $cartDetail = new CartDetail;
            $cartDetail->cart_id = $cart->id;
            $cartDetail->album_id = $request->album;
            $cartDetail->photo_id = $request->reference;
            $cartDetail->amount = config('app.price_per_photo');
            $cartDetail->save();
        } else {
            $cart = Cart::where('user_id', Auth::user()->id)->first();

            if (CartDetail::where([['cart_id', $cart->id], ['album_id', $request->album], ['photo_id', $request->reference]])->first()) {
                return json_encode(['status' => 1]);
            } else {

                $cartDetail = new CartDetail;
                $cartDetail->cart_id = $cart->id;
                $cartDetail->album_id = $request->album;
                $cartDetail->photo_id = $request->reference;
                $cartDetail->amount = config('app.price_per_photo');
                $cartDetail->save();

                $cart->total += config('app.price_per_photo');
                $cart->items++;
                $cart->save();
            }
        }

        return json_encode(['status' => 0]);
    }

    public function addPhoto(Request $request)
    {
        /*
        Return status
        Success - 0
        Already exists - 1
        Photo unavailable - 2
        */

        if (Album::findOrFail($request->album)->publication_time < date('Y-m-d'))
            return redirect()->back()->withErrors(["¡La foto no se encuentra disponible!"]);

        $cart = Cart::class;
        $cartDetail = CartDetail::class;

        if (Cart::where('user_id', Auth::user()->id)->first() === null)
        {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->items = 1;
            $cart->total = config('app.price_per_photo');
            $cart->save();

            $cartDetail = new CartDetail;
            $cartDetail->cart_id = $cart->id;
            $cartDetail->album_id = $request->album;
            $cartDetail->photo_id = $request->reference;
            $cartDetail->amount = config('app.price_per_photo');
            $cartDetail->save();
        } else {
            $cart = Cart::where('user_id', Auth::user()->id)->first();

            if (CartDetail::where([['cart_id', $cart->id], ['album_id', $request->album], ['photo_id', $request->reference]])->first()) {
                return redirect()->back()->with('success', "¡Foto en el carrito!");
            } else {

                $cartDetail = new CartDetail;
                $cartDetail->cart_id = $cart->id;
                $cartDetail->album_id = $request->album;
                $cartDetail->photo_id = $request->reference;
                $cartDetail->amount = config('app.price_per_photo');
                $cartDetail->save();

                $cart->total += config('app.price_per_photo');
                $cart->items++;
                $cart->save();
            }
        }

        return redirect()->back()->with('success', "¡Se ha añadido la foto al carrito!");
    }

    public function addAlbum(Request $request)
    {
        if (Album::findOrFail($request->album)->publication_time < date('Y-m-d'))
            return redirect()->back()->withErrors(["¡El álbum no se encuentra disponible!"]);

        $photosId = AlbumPhoto::where('album_id', $request->album)->get('photo_id');

        foreach ($photosId as $photoId) {
            if (Cart::where('user_id', Auth::user()->id)->first() === null)
            {
                $cart = new Cart;
                $cart->user_id = Auth::user()->id;
                $cart->items = 1;
                $cart->total = config('app.price_per_photo');
                $cart->save();

                $cartDetail = new CartDetail;
                $cartDetail->cart_id = $cart->id;
                $cartDetail->album_id = $request->album;
                $cartDetail->photo_id = $photoId->photo_id;
                $cartDetail->amount = config('app.price_per_photo');
                $cartDetail->save();
            } else {
                $cart = Cart::where('user_id', Auth::user()->id)->first();

                if (CartDetail::where([['cart_id', $cart->id], ['album_id', $request->album], ['photo_id', $photoId->photo_id]])->first()) {
                    continue;
                } else {
                    $cartDetail = new CartDetail;
                    $cartDetail->cart_id = $cart->id;
                    $cartDetail->album_id = $request->album;
                    $cartDetail->photo_id = $photoId->photo_id;
                    $cartDetail->amount = config('app.price_per_photo');
                    $cartDetail->save();

                    $cart->total += config('app.price_per_photo');
                    $cart->items++;
                    $cart->save();
                }
            }
        }

        return redirect()->back()->with('success', "¡Se ha añadido el álbum al carrito!");
    }

    public function removePhoto($cartDetailId)
    {
        $cartDetail = CartDetail::findOrFail($cartDetailId);
        $cart = Cart::findOrFail($cartDetail->cart_id);

        if ($cart->user_id !== Auth::user()->id) {
            return back()->withErrors(["¡Se ha producido un error!"]);
        }

        $cart->total -= config('app.price_per_photo');
        $cart->items -= 1;
        $cart->save();

        $cartDetail->delete();

        if ($cart->items == 0) {
            $cart->delete();
        }

        return back()->with('success', "¡Foto removida del carrito!");
    }

    public function emptyCart($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        if ($cart->user_id !== Auth::user()->id) {
            return back()->withErrors(["¡Se ha producido un error!"]);
        }

        DB::table('cart_details')->where('cart_id', $cartId)->delete();
        $cart->delete();

        return back()->with('success', "¡Se ha vaciado el carrito!");
    }
}
