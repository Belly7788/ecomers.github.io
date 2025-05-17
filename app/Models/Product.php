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
        'category',
        'regular_price',
        'discount',
        'status',
        'create_by',
    ];

    // Relationships
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
}
