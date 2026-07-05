<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type_Court;

class Court extends Model
{
    use HasFactory;

    protected $table = 'court';
    protected $fillable = [
        'name',
        'type_court_id',
        'price',
    ];

    public function courtType(){
        return $this->belongsTo(Type_Court::class, 'type_court_id');
    }
}
