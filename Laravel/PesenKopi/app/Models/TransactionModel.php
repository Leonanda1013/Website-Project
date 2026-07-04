<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'kopi_id',
        'amount',
        'note',
        'date',
    ];

    public function kopi(){
        return $this->belongsTo(KopiModel::class, 'kopi_id');
    }
}
