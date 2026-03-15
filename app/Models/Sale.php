<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
    'folio',
    'client_id',
    'subtotal',
    'total'
];

public function client(){
    return $this->belongsTo(Client::class);
}

public function details(){
    return $this->hasMany(SaleDetail::class);
}

}
