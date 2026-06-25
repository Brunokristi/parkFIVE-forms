<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckinGuest extends Model
{
    protected $fillable = [
        'checkin_id',
        'first_name',
        'last_name',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function checkin(): BelongsTo
    {
        return $this->belongsTo(Checkin::class);
    }
}