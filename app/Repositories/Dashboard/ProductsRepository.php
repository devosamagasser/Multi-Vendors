<?php

namespace App\Repositories\Dashboard;
use App\Interfaces\Dashboard\ProductsInterface;
use App\Models\Product;
use App\Traits\ImagesTrait;

class ProductsRepository  extends Repository implements ProductsInterface
{
    use ImagesTrait;

    public function __construct(Product $model)
    {
        $this->mainModel = $model;
        $this->endPoint = 'dashboard';
        $this->mainRoute = $this->endPoint .'.'. $this->mainModel::SECTION ;
    }

    public function index()
    {
//        $categories = $this->mainModel::->paginate(3);
        $products = $this->mainModel::with(['store','category'])->filter(request()->query())->paginate(3);

        return $this->customView('index','Data',['products' => $products]);
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
        $this->deleteImage($category->dashboard_image);
        $category->forceDelete();

        return $this->backTo($this->mainRoute.'.trash',['status'=>'done','body'=>'Category Deleted Successfully']);
    }
}
