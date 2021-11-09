<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['icon', 'name', 'slug']; 
    public function products(){
        return $this->hasMany(Product::class);
    }
}
