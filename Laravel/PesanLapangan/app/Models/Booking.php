<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Court;


class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'customer_name',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
    ];

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }
}
