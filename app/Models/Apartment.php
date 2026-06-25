<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'address',
        'checkin_time',
        'access_code',
        'wifi_name',
        'wifi_password',
        'parking_info',
        'pool_info',
        'contact_info',
    ];

    public function checkins(): HasMany
    {
        return $this->hasMany(Checkin::class);
    }
}