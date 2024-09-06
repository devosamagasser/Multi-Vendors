<?php

namespace App\Repositories\Dashboard;
use App\Interfaces\Dashboard\CategoriesInterface;

use App\Models\Category;
use App\Traits\ImagesTrait;
use Illuminate\Support\Str;

class CategoriesRepository extends Repository implements CategoriesInterface
{
    use ImagesTrait;

    public function __construct(Category $category)
    {
        $this->mainModel = $category;
        $this->endPoint = 'dashboard';
    }

    public function index()
    {
        $categories = $this->mainModel::get();
        return $this->customView('index','Data',['categories' => $categories]);
    }

    public function create()
    {
        $categories = $this->mainModel::get();
        $category = new Category();
        $merged_data = ['category' => $category,'categories' => $categories];
        return $this->customView('create','Add Category',$merged_data);
    }

    public function store($request)
    {
        $request->merge([
           'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');
        $data['image'] = ($request->hasFile('image')) ? $this->moveImage($request->file('image')) : null;
        $this->mainModel::create($data);
        return $this->backHome('Category Created Successfully');
    }

    public function show($category)
    {
        // TODO: Implement show() method.
    }

    public function edit($category)
    {
        $categories = $this->mainModel::where('id','<>',$category->id)->where(function ($query) use($category) {
            $query->whereNull('parent_id')->orWhere('parent_id','<>',$category->id);
        })->get();

        $merged_data = ['category' => $category,'categories' => $categories];
        return $this->customView('edit','Edit Category',$merged_data);
    }

    public function update($request, $category)
    {
        $data = $request->except('image');
        $data['image'] = ($request->hasFile('image')) ? $this->updateImage($request->file('image'),$category->dashboard_image) : $category->image;
        $category->update($data);
        return $this->backHome('Category Updated Successfully');
    }

    public function destroy($category)
    {
        $this->deleteImage($category->dashboard_image);
        $category->delete();
        return $this->backHome('Category Deleted Successfully');
    }

}
