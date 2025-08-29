<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id','supplier_id','name','sku','barcode','cost','price','quantity','image'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->barcode)) {
                // simple deterministic barcode based on SKU
                $product->barcode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $product->sku));
            }
        });
    }

    public function category() { return $this->belongsTo(Category::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function movements() { return $this->hasMany(StockMovement::class); }
}
