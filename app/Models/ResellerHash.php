<?php

namespace App\Models;

use App\Traits\PermissionScopeTrait;
use Illuminate\Database\Eloquent\Model;

class ResellerHash extends Model
{
    use PermissionScopeTrait;

    private static $time = 1;

    protected $fillable = [
        'hash',
        'reseller_id',
    ];

    protected $hidden = [
        'reseller_id',
        'updated_at',
        'created_at',
    ];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function users()
    {
        return $this->reseller->users();
    }
}
