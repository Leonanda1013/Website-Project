<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Categories;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'stock',
        'category_id',
    ];

    public function categories(){
        return $this->belongsTo(Categories::class);
    }
}
