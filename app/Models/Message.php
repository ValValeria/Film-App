<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $fillable=[
        "message","status","id","user_id"
    ];

    /**
     * @return \App\Models\User
     */
    public function user(){
       return $this->belongsTo(User::class,'user_id');
    }
}
