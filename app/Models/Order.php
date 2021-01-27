<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;


class Order extends Model
{
    use HasFactory;
    protected $table = 'laravel_order';
    public $timestamps = false;
    public $fillable = [
        "product_id", "quantity", "user_id", "status"
    ];


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function user()
    {
        return  $this->belongsTo(User::class,'user_id')->withDefault();
    }
}
