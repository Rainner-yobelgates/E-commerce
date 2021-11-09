<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'invoice_code', 'first_name', 'last_name', 'email', 'phone', 'province', 'city', 'subdistrict', 'postal_code', 'courier', 'courier_service', 'address', 'cost', 'total_price', 'subtotal', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function proof(){
        return $this->hasOne(Proof::class);
    }
}
