<?php

namespace App\Models;

use App\Rules\FilterRules;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    public const SECTION = 'categories';

    protected $fillable = ['name','parent_id','slug','description','image','status'];
//    protected $guarded = ['id','created_at','updated_at'];

    public function parent()
    {
        return $this->belongsTo(static::class,'parent_id')->withDefault(['name'=>'-']);
    }

    public function children()
    {
        return $this->hasMany(static::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->with('store');
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'categories\\' . $value
        );
    }

    public static function rules()
    {
        $id = request()->route('category')->id;
        return [
            'name' => [
                "required",
                "string",
                "max:255",
                "unique:categories,name,$id",
//                function ($attr,$value,$fails) {
//                    if(strtolower($value) === 'laravel'){
//                        $fails('this name is forbidden!');
//                    }
//                },
//                new FilterRules(['laravel','osama']), // custom rule in rules
//                'filter:laravel,osama' // custom rule in app service provider
            ],
            'parent_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:10000|dimensions:min_width=100,min_height=100',
            'status' => 'required|in:Active,Inactive',
        ];
    }

    public function scopeFilter (Builder $builder,array $filter)
    {
        $builder->when($filter['name'] ?? false,function ($builder,$value){
            $builder->where('categories.name','LIKE',"%{$value}%");
        });

        $builder->when($filter['status'] ?? false,function ($builder,$value){
            $builder->where('categories.status',$value);
        });
    }



}
