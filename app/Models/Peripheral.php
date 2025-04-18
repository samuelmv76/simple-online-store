<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peripheral extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category_id',
        'price',
        'stock',
        'description',
        'image_url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
