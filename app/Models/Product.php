<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const SECTION = 'categories';

//    protected $fillable = ['name','slug','stock','description','image','price','compare_price','options','rate','featured','store_id','category_id','status'];

    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    protected static function booted()
    {
        static::addGlobalScope('store',new StoreScope());
    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id')->with('user');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->with('parent');
    }

    public function scopeFilter (Builder $builder,array $filter)
    {
        $builder->when($filter['name'] ?? false,function ($builder,$value){
            $builder->where('products.name','LIKE',"%{$value}%");
        });

//        $builder->when($filter['status'] ?? false,function ($builder,$value){
//            $builder->where('products.status',$value);
//        });
    }
}
