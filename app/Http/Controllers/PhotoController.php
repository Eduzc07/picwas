<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use App\AlbumPhoto;
use App\PurchasedPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('photographer-only', ['only' => ['addBest', 'getBestPhotos']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('albums.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $albumId)
    {
        $request->validate([
            // 'add_photos' => ['required', 'max:'.config('app.max_multiple_file')],
            'add_photos' => ['required', 'max:500'],
            'add_photos.*' => ['image', 'mimes:jpeg,png,jpg', 'max:'.config('app.max_file_upload_size')]
            // 'add_photos' => ['required'],
            // 'add_photos.*' => ['image', 'mimes:jpeg,png,jpg']
        ]);

        // dd($request);

        if($request->hasfile('add_photos')) {
            foreach($request->file('add_photos') as $addPhoto) {
                $photoName = Auth::user()->id.'_album_'.$albumId.'_'.(time()*rand(1, 4)+rand(0, 50000)).'.'.$addPhoto->getClientOriginalExtension();

                //Use the initial price
                $album = Album::findOrFail($albumId);

                $photo = new Photo;
                $photo->user_id = Auth::user()->id;
                $photo->original_image = $photoName;
                $photo->modified_image = $photoName;
                // $photo->price = config('app.price_per_photo');
                $photo->price = $album->price;
                $photo->save();

                //$photoId = DB::table('photos')->insertGetId(['user_id'=>Auth::user()->id, 'original_image' => $photoName, 'modified_image' => $photoName]);

                $addPhoto->move(storage_path('app/private/photos'), $photoName);

                //DB::table('albums_photos')->insert(['album_id'=>$albumId, 'photo_id' => $photoId]);

                $albumPhoto = new AlbumPhoto;
                $albumPhoto->album_id = $albumId;
                $albumPhoto->photo_id = $photo->id;
                $albumPhoto->save();

                // Add watermark
                $watermark = public_path('img/watermark.png'); // Watermark image to insert
                $image = Image::make(storage_path('app/private/photos/').$photoName);

                // Calculate resize value
                $originalWidth = $image->width();
                $originalHeight = $image->height();

                if ($originalWidth > 640) {
                    // resize the image to a width of 1280 and constrain aspect ratio (auto height)
                    $image->resize(640, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if ($originalHeight > 480) {
                    // resize the image to a width of 1280 and constrain aspect ratio (auto height)
                    $image->resize(null, 480, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                // $image->insert($watermark, 'center', 5, 5);
                $image->insert($watermark, 'center');
                $image->save(public_path('storage/albums_photos/').$photoName);
            }
        }

        return redirect()->back()->with('success', "¡Se han añadido fotos a tu álbum!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(Request $request)
    {
        //Update Price of photo
        $photo = Photo::findOrFail($request->photo);
        $photo->price = $request->price;
        $photo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idAlbum, $idPhoto)
    {
        $photo = Photo::findOrFail($idPhoto);
        $albumPhoto = AlbumPhoto::where([['album_id', '=', $idAlbum], ['photo_id', '=', $idPhoto]])->first();

        if (Auth::user()->id !== $photo->user_id || Auth::user()->id !== Album::findOrFail($idAlbum)->user_id) {
            return redirect()->back();
        }

        if (is_file(storage_path('app/private/photos/').$photo->original_image)){
            File::delete(storage_path('app/private/photos/').$photo->original_image);
        }

        if (Storage::exists('albums_photos/'.$photo->modified_image)){
            Storage::delete('albums_photos/'.$photo->modified_image);
        }

        $albumPhoto->delete();
        $photo->delete();

        return redirect()->back()->with('success', "¡Se ha eliminado la foto de tu álbum!");
    }

    public function addBest(Request $request)
    {
        if ($request->album) {
            $album = Album::findOrFail($request->album);

            if ($album->user_id != Auth::user()->id) {
                return json_encode(['status'=>1]);
            }

            $photo = Photo::findOrFail($request->photo);

            if (AlbumPhoto::where([['album_id', $album->id], ['photo_id', $photo->id]])->first() == null) {
                return json_encode(['status'=>2]);
            }
        } else {
            $photo = Photo::findOrFail($request->photo);

            if ($photo->user_id != Auth::user()->id) {
                return json_encode(['status'=>1]);
            }
        }

        $photo->best = $photo->best == true ? false : true;
        $photo->save();

        return json_encode(['status'=>0]);
    }

    public function getBestPhotos()
    {
        $photos = Photo::where([['user_id', Auth::user()->id], ['best', true]])->paginate(12);

        return view('albums.show_best_photos', compact('photos'));
    }

    public function purchasedPhotos()
    {
        $photos = PurchasedPhoto::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(12);

        return view('purchased.photos', compact('photos'));
    }

    public function download($photoId) {
        $photo = DB::table('purchased_photos')->where('id', $photoId)->first();

        if (!empty($photo) && $photo->user_id === Auth::user()->id) {
            return response()->download(storage_path("app/private/purchased_photos/$photo->original_image"), (time()*rand(1, 4)+rand(0, 50000)).".".pathinfo($photo->original_image, PATHINFO_EXTENSION));
        } else {
            return redirect()->route('photos.purchased');
        }
    }
}
