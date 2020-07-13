<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use App\AlbumPhoto;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('photographer-only', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'album_name' => ['required', 'string', 'max:150'],
            'album_cover' => ['image', 'mimes:jpeg,png,jpg', 'max:'.config('app.max_file_upload_size')],
            'topic' => ['required', 'string', 'max:255', 'in:Deporte,Danzas,Lugares Turísticos,Otros'],
            'place' => ['nullable', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0|digits_between: 0.00, 100.00'],
            'description' => ['nullable', 'string', 'max:255']
        ]);

        $now = date('Y-m-d');
        $publishedUntil = strtotime($now."+ 15 days");
        $publishedUntil = date('Y-m-d', $publishedUntil);

        $album = new Album;
        $album->user_id = Auth::user()->id;
        $album->name = $request->album_name;
        $album->publication_time = $publishedUntil;
        $album->place = $request->place;
        $album->price = $request->price;
        $album->description = $request->description;
        $album->category = $request->topic;
        $album->privacy_public = true;
        $album->save();

        if ($request->hasFile('album_cover') && $request->file('album_cover')->isValid()) {
            // Set image with the id of the recent inserted album
            $id = $album->id;
            $coverName = Auth::user()->id.'_album_cover_'.$id.'_'.time().'.'.request()->album_cover->getClientOriginalExtension();

            $album = Album::findOrFail($id);
            $album->cover_photo = $coverName;
            $album->save();

            $request->album_cover->storeAs('albums', $coverName);
        }

        // return redirect()->route('user', [Auth::user()->username])->with('success', "¡Se ha creado tu álbum!");
        return redirect()->route('albums.show', [$album->id])->with('success', "¡Se ha creado tu álbum!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        if (Gate::allows('album_owner', $album)) {
            $photos = Photo::whereIn('id', AlbumPhoto::where('album_id', $id)->get('photo_id'))->orderBy('best', 'desc')->orderBy('created_at', 'desc')->paginate(20);

            return view('albums.show', compact(['album', 'photos']));
        } else {
            if ($album->publication_time >= date('Y-m-d')) {
                $photos = Photo::whereIn('id', AlbumPhoto::where('album_id', $id)->get('photo_id'))->orderBy('best', 'desc')->orderBy('created_at', 'desc')->paginate(20);

                return view('albums.show', compact(['album', 'photos']));
            } else {
                return abort(404);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);

        if (Auth::user()->id !== $album->user_id) {
            return redirect()->route('albums.index');
        }

        return view('albums.edit', compact('album'));
    }

    /**
     * Update, 'destroy' the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'album_name' => ['required', 'string', 'max:150'],
            'album_cover' => ['image', 'mimes:jpeg,png,jpg', 'max:'.config('app.max_file_upload_size')],
            'topic' => ['required', 'string', 'max:255', 'in:Deporte,Danzas,Lugares Turísticos,Otros'],
            'place' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255']
        ]);

        $album = Album::findOrFail($id);
        $album->name = $request->album_name;
        $album->place = $request->place;
        $album->description = $request->description;
        $album->category = $request->topic;

        if ($request->hasFile('album_cover') && $request->file('album_cover')->isValid()) {
            $coverName = Auth::user()->id.'_album_cover_'.$id.'_'.time().'.'.request()->album_cover->getClientOriginalExtension();

            $defaultCoverPhoto = $this->getDefaultColumnValue('cover_photo', $album);

            // remove quotation marks returned by the getDefaultColumnValue function
            $defaultCoverPhoto = substr($defaultCoverPhoto, 1);
            $defaultCoverPhoto = substr($defaultCoverPhoto, 0, -1);

            if ($album->cover_photo !== $defaultCoverPhoto) {
                if (Storage::exists('albums/'.$album->cover_photo)) {
                    Storage::delete('albums/'.$album->cover_photo);
                }
            }

            $album->cover_photo = $coverName;

            $request->album_cover->storeAs('albums', $coverName);
        }

        $album->save();

        return redirect()->back()->with('success', "¡Se ha editado tu álbum!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $photosId = AlbumPhoto::where('album_id', $id)->get('photo_id');

        if (Auth::user()->id !== $album->user_id) {
            return redirect()->back();
        }

        $defaultCoverPhotoValue = $this->getDefaultColumnValue('cover_photo', $album);

        // remove quotation marks returned by the getDefaultColumnValue function
        $defaultCoverPhotoValue = substr($defaultCoverPhotoValue, 1);
        $defaultCoverPhotoValue = substr($defaultCoverPhotoValue, 0, -1);

        DB::table('albums_photos')->where('album_id', $id)->delete();

        foreach ($photosId as $photoId) {
            $photo = Photo::findOrFail($photoId->photo_id);

            if (is_file(storage_path('app/private/photos/').$photo->original_image)){
                File::delete(storage_path('app/private/photos/').$photo->original_image);
            }

            if (Storage::exists('albums_photos/'.$photo->modified_image)){
                Storage::delete('albums_photos/'.$photo->modified_image);
            }

            $photo->delete();
        }

        if ($album->cover_photo !== $defaultCoverPhotoValue) {
            if (Storage::exists('albums/'.$album->cover_photo)) {
                Storage::delete('albums/'.$album->cover_photo);
            }
        }

        $album->delete();

        return redirect()->route('user', [Auth::user()->username])->with('success', "¡Se ha eliminado tu álbum!");
    }

    /**
     * Return default value from model table
     *
     * @param string $columnName
     * @param Model $model
     * @return mixed
     */
    public function getDefaultColumnValue($columnName, $model)
    {
        $query = 'SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "' . $model->getTable() . '" AND COLUMN_NAME = "' . $columnName . '"';

        return Arr::pluck(DB::select($query), 'COLUMN_DEFAULT')[0]; // return with ', example: 'value'
    }
}
