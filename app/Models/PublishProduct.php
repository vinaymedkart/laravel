<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishProduct extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ws_code', 'name', 'sales_price', 'mrp', 'manufacturer_name', 
        'is_banned', 'is_active', 'is_discontinued', 'is_assured', 'is_refridged', 
        'category_id', 'combination', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected $casts = [
        'combination' => 'array',
    ];
}
