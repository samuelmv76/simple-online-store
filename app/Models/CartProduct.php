<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = 'cart_product';

    protected $fillable = [
        'peripheral_id',
        'cart_id',
        'count_product',
        'price_product',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function peripheral()
    {
        return $this->belongsTo(Peripheral::class, 'peripheral_id');
    }
}
