<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySchedule extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi via create() atau update()
    // Agar tidak terjadi mass asignment attack
    protected $fillable = [
        'subject',
        'description',
        'start_time',
        'end_time',
        'day_of_week',
        'color',
        'is_active',
    ];
    // Casting tipe data otomatis
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
