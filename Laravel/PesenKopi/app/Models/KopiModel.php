<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class KopiModel extends Model
{
    use HasFactory;

    protected $table = 'kopi';
    protected $fillable = [
        'nama_kopi',
        'harga'
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
