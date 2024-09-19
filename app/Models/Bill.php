<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['number','user_id','name','email','phone','address','city','country','total','status'];

    public function user(){
        return $this->belongsTo('users')->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products(){
        return $this->belongsToMany(Product::class,BillProduct::class,'bill_id','product_id','id', 'id')
            ->using(BillProduct::class)
            ->withPivot([
                'product_id' , 'product_name','product_price','product_compare_price','quantity','product_store_id'
            ]);
    }


    protected static function booted()
    {
        static::creating(function(Bill $bill){
            $bill->number = static::bilNumber();
            $bill->user_id = Auth::id();
        });
    }

    public static function bilNumber()
    {
        $year = Carbon::now()->year;
        $number = Bill::whereYear('created_at',$year)->max('number');
        if($number){
            return $number + 1;
        }
        return 1;
    }

    public function number(): Attribute
    {
        return Attribute::make(
            get : fn($value) => Carbon::now()->year . $value
        );
    }

}
