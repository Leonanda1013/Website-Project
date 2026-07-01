<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'note',
        'date',
        'time',
        'status',
    ];

    protected $casts = [
        'date' => 'date', //otomatis jadi Carbon date object

    ];
}
