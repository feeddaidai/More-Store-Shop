<?php

namespace App\Models;

use App\Service\JwtService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * laravel 自带
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * laravel 自带
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * laravel 自带
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isHasReg($account)
    {
        return (bool)self::where('mobile',$account)->count();
        #如果是手机号
        #如果是邮箱号
    }

    public function password($password)
    {
        return Hash::make($password);
    }

    public function checkPassword($str,$password)
    {
        return Hash::check($str,$password);
    }

    public function defaultName()
    {
        $stranger = self::orderBy('id','desc')->first();
        return config('admin.name') . (string)++$stranger->id;
    }

    public function execute($userId)
    {
        $jwt = JwtService::getInstance();
        return $jwt->getToken(['sub' => $userId]);
    }


}
