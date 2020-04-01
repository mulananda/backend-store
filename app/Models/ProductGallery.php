<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes; //menggunakan Softdelete

class ProductGallery extends Model
{
    use softDeletes;

    protected $fillable = [
        'products_id', 'photo', 'is_default'
    ];

    protected $hidden = [

    ];

    public function product()
    {
        // belongsT0(milik) productGalleri -> product
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    // accesor untuk menggnati photo getNamafieldAttribute
    public function getPhotoAttribute($value)
    {
        // jalankan php artisan storage:link (menggunakan file storage dalam laravel agar folder tersebut bisa di akses public)
        return url('storage/' . $value);
    }
}
