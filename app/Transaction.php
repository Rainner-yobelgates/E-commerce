<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'product_id', 'amount'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
