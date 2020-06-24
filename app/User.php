<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'description', 'country_id', 'birthdate', 'username', 'role_id', 'avatar', 'email', 'password', 'account_visibility_public',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopePhotographers()
    {
        return $this->where([['role_id', DB::table('roles')->where('name', 'photographer')->first()->id], ['account_visibility_public', true]]);
    }

    public function scopeCountry($query, $countryId)
    {
        return $query->where('country_id', $countryId);
    }
}
