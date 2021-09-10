<?php

namespace App\Models;

use App\Traits\PermissionScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use PermissionScopeTrait;

    protected $fillable = [
        'fee_percentage',
        'name',
        'email',
        'phone_number',
        'website',
        'country',
        'address',
        'city',
        'postcode'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function reseller_hashes()
    {
        return $this->hasMany(ResellerHash::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
