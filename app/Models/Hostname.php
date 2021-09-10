<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostname extends Model
{
    protected $fillable = [
        'fqdn',
        'redirect_to',
        'force_https',
        'under_maintenance_since',
        'website_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
