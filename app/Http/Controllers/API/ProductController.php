<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product; // panggil model productnya
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function all (Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $slug = $request->input('slug');
        $type = $request->input('type');
        $price_from = $request->input('price_from'); //harga terendah sampai price_to
        $price_to = $request->input('price_to'); // harga tertiggi

        // mengambil data berdasarkan id
        // jika request id ada
        if($id)
        {       
            $product = Product::with('galleries')->find($id); // galleries = nama function relasi di model product
            
            // jika request id product berhasil ditemukan
            if($product){
                return ResponseFormatter::success($product, 'Data Produk Berhasil di Ambil');
            }else{
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
            }
        }
        // mengambil data berdasarkan slug
        // jika request id ada
        if($slug)
        {   
            $product = Product::with('galleries') // galleries = nama function relasi di model product
                ->where('slug', $slug)
                ->first(); //ambil data yg paling pertama
            
            // jika request slug product berhasil ditemukan
            if($product){
                return ResponseFormatter::success($product, 'Data Produk Berhasil di Ambil');
            }else{
                return ResponseFormatter::error(null, 'Data Produk Tidak Ada', 404);
            }
        }

        // request data berdasarkan nama, type, price dari terendah ke termahal
        $product = Product::with('galleries');
        if($name)
            $product->where('name', 'like', '%' . $name . '%');

        if($type)
            $product->where('type', 'like', '%' . $type . '%');

        if($price_from)
            $product->where('price', '>=', $price_from);

        if($price_to)
            $product->where('price', '<=', $price_to);

        return ResponseFormatter::success(
            $product->paginate($limit), 'Data List Produk Berhasil di Ambil'
        );
    }
}
