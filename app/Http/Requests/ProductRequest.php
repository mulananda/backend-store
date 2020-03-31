<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true; // jadikan true agar bisa digunakan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // validasi rules
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',

        ];
    }
}
