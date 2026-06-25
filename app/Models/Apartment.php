<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'label',
        'address',
        'checkin_time',
        'checkout_time',
        'access_code',
        'wifi_name',
        'wifi_password',
        'parking_info',
        'pool_info',
        'arrival_instructions',
        'key_instructions',
        'quiet_hours',
        'smoking_policy',
        'pets_policy',
        'early_checkin',
        'equipment',
        'trash_info',
        'invoice_info',
        'contact_info',
    ];

    protected $casts = [
        'equipment' => 'array',
    ];

    public function checkins(): HasMany
    {
        return $this->hasMany(Checkin::class);
    }
}