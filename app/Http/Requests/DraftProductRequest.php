<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DraftProductRequest extends FormRequest {
    public function authorize() {
        return true; 
    }

    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'sales_price' => 'required|numeric|min:0',
            'mrp' => 'required|numeric|min:0',
            'manufacturer_name' => 'required|string|max:255',
            'is_banned' => 'boolean',
            'is_active' => 'boolean',
            'is_discontinued' => 'boolean',
            'is_assured' => 'boolean',
            'is_refridged' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'combination' => 'required|array',
            
        ];
    }
}
