<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'image', 'name', 'slug', 'condition', 'weight', 'description', 'stock', 'price'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
