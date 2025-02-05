<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DraftProduct extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'sales_price', 'mrp', 'manufacturer_name', 'is_banned',
        'is_active', 'is_discontinued', 'is_assured', 'is_refridged', 
        'category_id', 'product_status', 'ws_code', 'combination',
        'created_by', 'updated_by', 'deleted_by', 'published_by',
        'published_at', 'unpublished_by', 'unpublished_at'
    ];

    protected $casts = [
        'combination' => 'array',
    ];
}
