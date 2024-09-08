<?php

namespace App\Models;

use App\Rules\FilterRules;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public const SECTION = 'categories';

    protected $fillable = ['name','parent_id','slug','description','image','status'];
//    protected $guarded = ['id','created_at','updated_at'];

    protected $appends = ['dashboard_image'];

    public function dashboardImage(): Attribute
    {
        return Attribute::make(
            get: fn () => 'dashboard\categories\\' . $this->image
        );
    }

    public static function rules()
    {
        $id = request()->route('category');
        return [
            'name' => [
                "required",
                "string",
                "max:255",
                "unique:categories,name,$id",
                function ($attr,$value,$fails) {
                    if(strtolower($value) == 'laravel'){
                        $fails('this name is forbidden!');
                    }
                },
                new FilterRules(['laravel','osama']), // custom rule in rules
                'filter:laravel,osama' // custom rule in app service provider
            ],
            'parent_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:10000|dimensions:min_width=100,min_height=100',
            'status' => 'required|in:Active,Inactive',
        ];
    }

    public function messages()
    {
//        return [
//            'required' => ':Attribute deosn't enter',
//            'name.required' => 'Please enter your name.',
//            'name.max' => 'The name may not be greater than 255 characters.',
//        ];
    }

}
