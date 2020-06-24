<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $countriesCode = ['AF', 'AL', 'DE', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AN', 'SA', 'DZ', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BY', 'MM', 'BO', 'BA', 'BW', 'BR', 'BN', 'BG', 'BF', 'BI', 'CV', 'KH', 'CM', 'CA', 'TD', 'CL', 'CN', 'CY', 'VA', 'CO', 'KM', 'CG', 'KR', 'KP', 'CI', 'CR', 'HR', 'CU', 'DK', 'DJ', 'DM', 'EC', 'EG', 'SV', 'AE', 'ER', 'SK', 'SI', 'ES', 'US', 'EE', 'ET', 'MK', 'PH', 'FI', 'FR', 'GA', 'GM', 'GE', 'GS', 'GH', 'GI', 'GD', 'GR', 'GL', 'GP', 'GU', 'GT', 'GY', 'GF', 'GN', 'GQ', 'GW', 'HT', 'NL', 'HN', 'HK', 'HU', 'IN', 'ID', 'IQ', 'IR', 'IE', 'BV', 'CX', 'HM', 'IS', 'KY', 'CK', 'CC', 'FO', 'FJ', 'FK', 'MP', 'MH', 'UM', 'PW', 'SB', 'TK', 'TC', 'VI', 'VG', 'IL', 'IT', 'JM', 'JP', 'JO', 'KZ', 'KE', 'KG', 'KI', 'KW', 'LA', 'LS', 'LV', 'LB', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MG', 'MY', 'MW', 'MV', 'ML', 'MT', 'MA', 'MQ', 'MU', 'MR', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'MS', 'MZ', 'NA', 'NR', 'NP', 'NI', 'NE', 'NG', 'NU', 'NF', 'NO', 'NC', 'NZ', 'OM', 'PA', 'PG', 'PK', 'PY', 'PE', 'PN', 'PF', 'PL', 'PT', 'PR', 'QA', 'UK', 'CF', 'CZ', 'ZA', 'CD', 'DO', 'RE', 'RW', 'RO', 'RU', 'WS', 'AS', 'KN', 'SM', 'PM', 'VC', 'SH', 'LC', 'ST', 'SN', 'YU', 'SC', 'SL', 'SG', 'SY', 'SO', 'LK', 'SZ', 'SD', 'SE', 'CH', 'SR', 'SJ', 'TH', 'TW', 'TZ', 'TJ', 'IO', 'TF', 'TP', 'TG', 'TO', 'TT', 'TN', 'TM', 'TR', 'TV', 'UA', 'UG', 'UY', 'UZ', 'VU', 'VE', 'VN', 'WF', 'YE', 'ZM', 'ZW'];

        $data['username'] = strtolower($data['username']);
        $data['email'] = strtolower($data['email']);

        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255', Rule::in($countriesCode)],
            'birthdate' => ['required', 'date'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age_verification' => ['accepted'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $countryId = Country::where('alpha_2_code', strtoupper($data['country']))->first()->id;
        return User::create([
            'first_name' => ucwords($data['firstname']),
            'last_name' => ucwords($data['lastname']),
            'country_id' => $countryId,
            'birthdate' => $data['birthdate'],
            'username' => strtolower($data['username']),
            'role_id' => 1, // photographer
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return redirect()->route('/');
    }

    public function registerCustomer(Request $request)
    {
        $countriesCode = ['AF', 'AL', 'DE', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AN', 'SA', 'DZ', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BY', 'MM', 'BO', 'BA', 'BW', 'BR', 'BN', 'BG', 'BF', 'BI', 'CV', 'KH', 'CM', 'CA', 'TD', 'CL', 'CN', 'CY', 'VA', 'CO', 'KM', 'CG', 'KR', 'KP', 'CI', 'CR', 'HR', 'CU', 'DK', 'DJ', 'DM', 'EC', 'EG', 'SV', 'AE', 'ER', 'SK', 'SI', 'ES', 'US', 'EE', 'ET', 'MK', 'PH', 'FI', 'FR', 'GA', 'GM', 'GE', 'GS', 'GH', 'GI', 'GD', 'GR', 'GL', 'GP', 'GU', 'GT', 'GY', 'GF', 'GN', 'GQ', 'GW', 'HT', 'NL', 'HN', 'HK', 'HU', 'IN', 'ID', 'IQ', 'IR', 'IE', 'BV', 'CX', 'HM', 'IS', 'KY', 'CK', 'CC', 'FO', 'FJ', 'FK', 'MP', 'MH', 'UM', 'PW', 'SB', 'TK', 'TC', 'VI', 'VG', 'IL', 'IT', 'JM', 'JP', 'JO', 'KZ', 'KE', 'KG', 'KI', 'KW', 'LA', 'LS', 'LV', 'LB', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MG', 'MY', 'MW', 'MV', 'ML', 'MT', 'MA', 'MQ', 'MU', 'MR', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'MS', 'MZ', 'NA', 'NR', 'NP', 'NI', 'NE', 'NG', 'NU', 'NF', 'NO', 'NC', 'NZ', 'OM', 'PA', 'PG', 'PK', 'PY', 'PE', 'PN', 'PF', 'PL', 'PT', 'PR', 'QA', 'UK', 'CF', 'CZ', 'ZA', 'CD', 'DO', 'RE', 'RW', 'RO', 'RU', 'WS', 'AS', 'KN', 'SM', 'PM', 'VC', 'SH', 'LC', 'ST', 'SN', 'YU', 'SC', 'SL', 'SG', 'SY', 'SO', 'LK', 'SZ', 'SD', 'SE', 'CH', 'SR', 'SJ', 'TH', 'TW', 'TZ', 'TJ', 'IO', 'TF', 'TP', 'TG', 'TO', 'TT', 'TN', 'TM', 'TR', 'TV', 'UA', 'UG', 'UY', 'UZ', 'VU', 'VE', 'VN', 'WF', 'YE', 'ZM', 'ZW'];

        $request->username = strtolower($request->username);
        $request->email = strtolower($request->email);

        request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255', Rule::in($countriesCode)],
            'birthdate' => ['required', 'date'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age_verification' => ['accepted'],
        ]);

        $countryId = Country::where('alpha_2_code', strtoupper($request->country))->first()->id;

        $user = User::create([
            'first_name' => ucwords($request->firstname),
            'last_name' => ucwords($request->lastname),
            'country_id' => $countryId,
            'birthdate' => $request->birthdate,
            'username' => strtolower($request->username),
            'role_id' => 2, // customer
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'account_visibility_public' => false,
        ]);

        Auth::login($user);
        return Redirect::to("/user/$user->username");
    }
}
