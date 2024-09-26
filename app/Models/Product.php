<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public const SECTION = 'products';

    protected $fillable = ['name','slug','stock','description','image','price','compare_price','options','rate','featured','store_id','category_id','status'];

    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    protected $hidden = ['created_at','updated_at','deleted_at','image'];

    protected $appends = ['image_url'];

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id')->with('user');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->with('parent');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,ProductTags::class,'product_id','tag_id','id','id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new StoreScope());

        static::creating(function(Product $product){
            $product->slug = Str::slug($product->name);
            $product->store_id = Auth::user()->store_id ?? 32;
        });
    }

    public function scopeFilter (Builder $builder,array $filter)
    {
        $options = array_merge([
            'name' => null,
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ],$filter);
        $builder->when($options['name'],function ($builder,$value){
            $builder->where('name','LIKE',"%{$value}%");
        });
        $builder->when($options['store_id'],function ($builder,$value){
            $builder->where('store_id',$value);
        });
        $builder->when($options['category_id'],function ($builder,$value){
            $builder->where('category_id',$value);
        });
        $builder->when($options['tag_id'],function ($builder,$value){

//            $builder->whereRaw('id IN (select product_id from product_tag where tag_id = ?)',[$value]);
            $builder->whereRaw('EXISTS (select 1 from product_tag where tag_id = ? AND product_id = products.id)',[$value]);
//            $builder->whereExists(function ($query) use($value){
//               $query->select(1)
//                    ->from('product_tag')
//                    ->whereRaw('product_id = products.id')
//                    ->where('tag_id',$value);
//            });
//
//            $builder->whereHas('tags',function ($builder) use($value){
//               $builder->where('id',$value);
//            });
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
