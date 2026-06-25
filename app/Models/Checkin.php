<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checkin extends Model
{
    protected $fillable = [
        'apartment_id',
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_phone',
        'guest_count',
        'wants_invoice',
        'billing_name',
        'billing_address',
        'company_id',
        'tax_id',
        'vat_id',
        'consent',
    ];

    protected $casts = [
        'wants_invoice' => 'boolean',
        'consent' => 'boolean',
        'guest_count' => 'integer',
    ];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function guests(): HasMany
    {
        return $this->hasMany(CheckinGuest::class);
    }
}