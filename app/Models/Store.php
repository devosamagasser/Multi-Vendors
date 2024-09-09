<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','upadted_at'];

    public function products()
    {
        return $this->hasMany(Product::class)->with('categories');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
