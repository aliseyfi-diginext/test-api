<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = ['user_id'];
    protected $appends = ['payable', 'picture_path'];

    public function getPayableAttribute()
    {
        return $this->discount ? ($this->price - ($this->price * ($this->discount/100))) : $this->price;
    }

    public function getPicturePathAttribute()
    {
        if ($path = $this->picture) {
            $path = str_replace('public/', 'storage/', $path);
            return asset($path);
        }
    }
}
