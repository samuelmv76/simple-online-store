<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts'; // también aquí debe ser en plural si usas convenciones
    protected $primaryKey = 'id';

    public function cartProduct(): HasMany
    {
        return $this->hasMany(CartProduct::class, 'cart_id');
    }
}
