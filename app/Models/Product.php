<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'thumbnail',
        'brand_id',
        'description',
        'category_id',
        'regular_price',
        'discount',
        'status',
        'create_by',
        'color_id', // Add color_id
        'size_id',  // Add size_id
        'stock',    // Add stock
    ];

    // Relationships
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    // Optional: Accessor to get color_id and size_id as arrays
    public function getColorIdsAttribute()
    {
        return $this->color_id ? explode(',', $this->color_id) : [];
    }

    public function getSizeIdsAttribute()
    {
        return $this->size_id ? explode(',', $this->size_id) : [];
    }
}
