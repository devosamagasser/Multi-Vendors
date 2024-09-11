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
        $this->mainRoute = $this->endPoint .'.'. $this->mainModel::SECTION ;
    }

    public function index()
    {
        $categories = $this->mainModel::with(['parent'])
            /**leftJoin('categories as parent','parent.id','=','categories.parent_id')
            ->select(['categories.*','parent.name as parent_name'])
            ->selectRaw("(select count(*) from products where products.category_id = categories.id) as products_count")*/
            ->withCount(['products'=>function ($query) {
                $query->whereStatus('active');
            }])
            ->withCount('children')
            ->filter(request()->query())->paginate(3);

        //scope -> latest() {order by name}
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
//        $categoryData = $category::with(['parent','children','products'])
//            ->withCount(['products'=>function ($query) {
//                $query->whereStatus('active');
//            }])
//            ->withCount('children');
        $products = $category->products()->paginate(3);
        return $this->customView('show',$category->name,['category' => $category,'products' => $products]);
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
        $data['image'] = ($request->hasFile('image')) ? $this->updateImage($request->file('image'),$category->image) : $category->image;
        $category->update($data);
        return $this->backHome('Category Updated Successfully');
    }

    public function destroy($category)
    {
        $category->delete();
        return $this->backHome('Category Deleted Successfully');
    }

    public function trash()
    {
        $categories = $this->mainModel::leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select(['categories.*', 'parent.name as parent_name'])
            ->filter(request()->query()) // Apply filters based on the request
            ->onlyTrashed() // Retrieve only soft-deleted records
            ->paginate(7); // Paginate the results

        return $this->customView('trash','Trashed Data',['categories' => $categories]);
    }

    public function restore($request, $category)
    {
        $category = $this->mainModel::onlyTrashed()->findOrFail($category);
        $category->restore();

        return $this->backTo($this->mainRoute.'.trash',['status'=>'done','body'=>'Category Restored Successfully']);
    }

    public function kill($request, $category)
    {
        $category = $this->mainModel::onlyTrashed()->findOrFail($category);
        $this->deleteImage($category->image);
        $category->forceDelete();

        return $this->backTo($this->mainRoute.'.trash',['status'=>'done','body'=>'Category Deleted Successfully']);
    }
}
