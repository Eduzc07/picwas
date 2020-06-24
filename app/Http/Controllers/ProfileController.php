<?php

namespace App\Http\Controllers;

use App\User;
use App\Album;
use App\PurchasedPhoto;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('user', [Auth::user()->username]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::firstWhere('username', $username);

        if ($user) {
            if ($user->account_visibility_public == false && $user->id != Auth::user()->id) {
                return view('profiles.private');
            }

            if ($user->role_id == 2) {
                $photos = PurchasedPhoto::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(12);

                return view('purchased.photos', compact('photos'));
            }

            if ($user->id === Auth::user()->id) {
                $albums = Album::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(9);
            } else {
                $albums = Album::where([['user_id', $user->id], ['publication_time', '>=', date('Y-m-d')]])->orderBy('created_at', 'desc')->paginate(9);
            }

            return view('profiles.show', compact(['user', 'albums']));
        } else{
            return view('profiles.not_exist', compact('username'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::firstWhere('username', $username);

        if ($user && $user->id === Auth::user()->id) {
            return view('profiles.edit', compact('user'));
        } else {
            return redirect()->route('user.edit', [Auth::user()->username]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral(Request $request)
    {
        $request->username = strtolower($request->username);
        $request->email = strtolower($request->email);

        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->first_name = ucwords(strtolower($request->firstname));
        $user->last_name = ucwords(strtolower($request->lastname));
        $user->username = strtolower($request->username);
        $user->email = strtolower($request->email);

        $user->save();

        return redirect()->route('user.edit', [strtolower($request->username)])->with('success', "¡Se han actualizado tus datos!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSecurityAndPrivacy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'sign_in_alert' => ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return redirect('/user/'.Auth::user()->username.'/edit/#securityAndPrivacy')->withErrors($validator)->withInput();
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->sign_in_alert = $request->sign_in_alert;

        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/user/'.Auth::user()->username.'/edit/#securityAndPrivacy')->with('success', "¡Se han actualizado tus datos!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => ['image', 'mimes:jpeg,png,jpg', 'max:'.config('app.max_file_upload_size')],
            'description' => ['nullable', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect('/user/'.Auth::user()->username.'/edit/#profile')->withErrors($validator)->withInput();
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->description = $request->description;

        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            $profilePhotoName = Auth::user()->id.'_profile_photo_'.(time()*rand(1, 4)+rand(0, 50000)).'.'.request()->profile_photo->getClientOriginalExtension();

            $defaultAvatarValue = $this->getDefaultColumnValue('avatar', $user);

            // remove quotation marks returned by the getDefaultColumnValue function
            $defaultAvatarValue = substr($defaultAvatarValue, 1);
            $defaultAvatarValue = substr($defaultAvatarValue, 0, -1);

            if ($user->avatar !== $defaultAvatarValue) {
                if (Storage::exists('avatars/'.$user->avatar)) {
                    Storage::delete('avatars/'.$user->avatar);
                }
            }

            $user->avatar = $profilePhotoName;

            $request->profile_photo->storeAs('avatars', $profilePhotoName);
        }

        $user->save();

        return redirect('/user/'.Auth::user()->username.'/edit/#profile')->with('success', "¡Se han actualizado tus datos!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateFinance(Request $request)
    {
        $withdrawalMethods = ['Banco de Crédito del Peru', 'Banco Interbank', 'Banco Scotiabank', 'Banco BBVA Continental', 'Mercadopago'];
        $identificationTypes = ['DNI', 'C.E', 'RUC', 'Otro'];

        $validator = Validator::make($request->all(), [
            'withdrawal_method' => [Rule::requiredIf(Auth::user()->role_id == 1), 'string', Rule::in($withdrawalMethods)],
            'withdrawal_account' => [Rule::requiredIf(Auth::user()->role_id == 1), 'string', 'max:1000'],
            'identification_type' => ['nullable', 'string', Rule::in($identificationTypes)],
            'identification_number' => ['nullable', 'string', 'max:20'],
            'phone_number' => ['nullable', 'string'],
            'zip_code' => ['nullable', 'string', 'max:256'],
            'street_name' => ['nullable', 'string', 'max:256'],
            'street_number' => ['nullable', 'string'],

        ]);

        if ($validator->fails()) {
            return redirect('/user/'.Auth::user()->username.'/edit/#finance')->withErrors($validator)->withInput();
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->withdrawal_method = $request->withdrawal_method;
        $user->withdrawal_account = $request->withdrawal_account;
        $user->identification_type = $request->identification_type;
        $user->identification_number = $request->identification_number;
        $user->phone_number = $request->phone_number;
        $user->zip_code = $request->zip_code;
        $user->street_name = $request->street_name;
        $user->street_number = $request->street_number;
        $user->save();

        return redirect('/user/'.Auth::user()->username.'/edit/#finance')->with('success', "¡Se han actualizado tus datos financieros!");
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
