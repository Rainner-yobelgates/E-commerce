<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'img', 'status'];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
