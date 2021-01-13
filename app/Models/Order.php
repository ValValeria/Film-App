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
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return  $this->belongsTo(User::class)->withDefault();
    }
}
