<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes; //menggunakan Softdelete

class Product extends Model
{
    use softDeletes;

    protected $fillable = [
        'name', 'type', 'description', 'price', 'slug', 'quantity'
    ];

    protected $hidden = [

    ];

    public function galleries()
    {
        // relasi ProductGallery dengan product
        return $this->hasMany(ProductGallery::class, 'products_id');
    }
}
