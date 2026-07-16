<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id','name','img','m_img','subtitle','price','market_price','status','is_stock','sort','tags','quantity','label','describe'
    ];

    public function attr()
    {
        return $this->hasMany(ProductAttr::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImgUrlAttribute()
    {
        $img = $this->img;
        if (empty($img)) return null;
        return url('storage/' . ltrim($img, '/'));
    }
}

