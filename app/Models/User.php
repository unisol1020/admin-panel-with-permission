<?php

namespace App\Models;

use App\Traits\PermissionScopeTrait;
use App\Traits\UserModelTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //Please put your all scopes and relations into UserModelTrait because we need duplicate code into User, Auth models

    use UserModelTrait , PermissionScopeTrait;

    private static $entity = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'city',
        'country',
        'phone',
        'birthdate',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
