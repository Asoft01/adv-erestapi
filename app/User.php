<?php

namespace App;

use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER= '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    public $transformer = UserTransformer::class;
    protected $table = 'users';
    protected $date = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'verified', 
        'verification_token', 
        'admin', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     // The hidden attribute is used to hide what is to be displayed in an array
    protected $hidden = [
        'password',
        'remember_token', 
        'verification_token'
    ];

    public function setNameAttribute($name){
        $this->attributes['name'] = strtolower($name);
    }

    public function getAttributeName($name){
        return ucwords($name);
    }

    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }


    public function isVerified(){
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
        return str_random(40);
    }
}
