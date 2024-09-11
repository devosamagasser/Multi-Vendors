<?php

namespace App\Repositories\Dashboard;
use App\Interfaces\Dashboard\ProductsInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\ImagesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $categories = Category::select('id','name')->get();
        $merged_data = ['product' => $this->mainModel,'categories' => $categories];
        return $this->customView('create','Add Product',$merged_data);
    }

    public function store($request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
            'store_id' => Auth::user()->store_id
        ]);
        $data = $request->except('image','tags');
        $data['image'] = ($request->hasFile('image')) ? $this->moveImage($request->file('image')) : null;
        $tags = explode(',',$request->tags);

        $savedTags = Tag::all();
        DB::transaction(function ()use($data,$savedTags,$tags){
            $product = $this->mainModel::create($data);
            $tags_id = [];
            foreach ($tags as $tag_name){
                $slug = Str::slug($tag_name);
                $tag = $savedTags->where('slug','=',$slug)->first();
                if(!$tag){
                    $tag = Tag::create([
                        'name'=>$tag_name,
                        'slug'=>$slug,
                    ]);
                }
                $tags_id[] = $tag->id;
            }
            $product->tags()->sync($tags_id);
        });
        return $this->backHome('Product Created Successfully');
    }

    public function show($product)
    {
        // TODO: Implement show() method.
    }

    public function edit($product)
    {
        $categories = Category::select('id','name')->get();
        $merged_data = ['product' => $product,'categories' => $categories];
        return $this->customView('edit','Update Product',$merged_data);
    }

    public function update($request, $product)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        $data = $request->except('image','tags');
        $data['image'] = ($request->hasFile('image')) ? $this->updateImage($request->file('image'),$product->dashboard_image) : $product->image;
        $tags = explode(',',$request->tags);

        $savedTags = Tag::all();
        DB::transaction(function ()use($product,$data,$savedTags,$tags){
            $product->update($data);
            $tags_id = [];
            foreach ($tags as $tag_name){
                $slug = Str::slug($tag_name);
                $tag = $savedTags->where('slug','=',$slug)->first();
                if(!$tag){
                    $tag = Tag::create([
                        'name'=>$tag_name,
                        'slug'=>$slug,
                    ]);
                }
                $tags_id[] = $tag->id;
            }
            $product->tags()->sync($tags_id);
        });
        return $this->backHome('Product Updated Successfully');
    }

    public function destroy($product)
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

    public function restore($request, $product)
    {
        $category = $this->mainModel::onlyTrashed()->findOrFail($product);
        $category->restore();

        return $this->backTo($this->mainRoute.'.trash',['status'=>'done','body'=>'Category Restored Successfully']);
    }

    public function kill($request, $product)
    {
        $category = $this->mainModel::onlyTrashed()->findOrFail($product);
        $this->deleteImage($category->dashboard_image);
        $category->forceDelete();

        return $this->backTo($this->mainRoute.'.trash',['status'=>'done','body'=>'Category Deleted Successfully']);
    }
}
