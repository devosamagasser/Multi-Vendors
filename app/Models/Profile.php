<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $guarded = ['created_at','updated_at'];

    public function profile()
    {
        return $this->belongsTo(User::class);
    }
}
