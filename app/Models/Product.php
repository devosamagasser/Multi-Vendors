<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public const SECTION = 'products';

    protected $fillable = ['name','slug','stock','description','image','price','compare_price','options','rate','featured','store_id','category_id','status'];

    protected $guarded = ['id','created_at','updated_at','deleted_at'];


    public function store(){
        return $this->belongsTo(Store::class,'store_id','id')->with('user');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->with('parent');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new StoreScope());
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

    public function scopeActive (Builder $builder): void
    {
        $builder->whereStatus('active');
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (){
                if (!$this->image) {
                    return "https://www.proclinic-products.com/build/static/default-product.30484205.png";
                } elseif (Str::startsWith($this->image, ['http://', 'https://'])) {
                    return $this->image;
                } else {
                    return asset('asset/images/products/' . $this->image);
                }
            }
        );
    }

    public function salePercent(): Attribute
    {
        return Attribute::make(
            get: function(){
               return ($this->compare_price) ? number_format((($this->compare_price - $this->price)/$this->compare_price) * 100,1) : 0;
            }
        );
    }


}
