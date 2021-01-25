<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'laravel_product';
    public $timestamps = false;
    public $fillable=['title','image',"category",'short_description','long_description','price','weight', 'ingredients'];
}
