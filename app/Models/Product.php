<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    // Tell Eloquent that the primary key is a UUID and it's not auto-incrementing
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'product'; // Set the correct table name

    //fillable fields is product
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->id)) {
                $product->id = Str::uuid();  // Generate a UUID if not already set
            }
        });
    }

    // Relationship with UserAddress model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Orders model
    public function orders()
    {
        return $this->belongsTo(Orders::class);
    }

    // Relationship with Comments model
    public function comments()
    {
        return $this->belongsTo(Comments::class);
    }

    // Relationship with Wishlists model
    public function wishLists()
    {
        return $this->belongsTo(Wishlists::class);
    }

    // Relationship with ProductImage model
    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

}
