<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Court;

class Type_Court extends Model
{
    use HasFactory;

    protected $table = 'type_court';
    protected $fillable = [
        'name',
    ];

    public function courts()
    {
        return $this->hasMany(Court::class, 'type_court_id');
    }
}
