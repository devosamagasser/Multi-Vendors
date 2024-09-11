

    <div class="card-body">
        <div class="custom-control custom-radio mb-3">
            <x-dashboard.form.radio name="status" :options="['Active'=>['reference'=>'active','status'=>'success'],'archived'=>['reference'=>'archived','status'=>'danger'],'draft'=>['reference'=>'draft','status'=>'secondary']]" :value="$data['product']['status']" />
        </div>
        <div class="form-group">
            <label for="Name">Product Name</label>
            <x-dashboard.form.input name="name" type="text" label="Product Name"  placeholder="Product Name" :value="$data['product']['name']" />
        </div>
        <div class="form-group">
            <label>Categories</label>
            <select name="category_id" class="form-control">
                @foreach($data['categories'] as $category)
                    <option value="{{$category->id}}" @selected($data['product']['category_id'] == $category->id)>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea @class(['form-control','is-invalid'=>$errors->has('description')]) name="description" id="description" placeholder="Product Description">{{old('description',$data['product']['description'])}}</textarea>
            @error('description')
            <div class="text-danger invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Product price</label>
            <x-dashboard.form.input name="price" label="Product price"  placeholder="Product price" :value="$data['product']['price']" />
        </div>
        <div class="form-group">
            <label for="tags">Product tags</label>
            <x-dashboard.form.input name="tags" label="Product tags"  placeholder="Product tags" value="" />
        </div>
        <div class="form-group">
            <label for="stock">Product stock</label>
            <x-dashboard.form.input name="stock" label="Product stock"  placeholder="Product stock" :value="$data['product']['stock']" />
        </div>
        <div class="form-group">
            <div class="custom-file">
                <label class="custom-file-label" for="image">Cover</label>
                <x-dashboard.form.input name="image" type="file" class="custom-file-input"/>
                @error('image')
                <div class="text-danger invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
