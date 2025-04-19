<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImagen extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'url_imagen',
        'peripheral_id',
    ];

    public function peripheral()
    {
        return $this->belongsTo(Peripheral::class);
    }
}
