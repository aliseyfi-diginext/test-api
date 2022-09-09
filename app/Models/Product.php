<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = ['user_id'];
    protected $appends = ['payable'];

    public function getPayableAttribute()
    {
        return $this->discount ? ($this->price - ($this->price * ($this->price/100))) : $this->price;
    }
}
