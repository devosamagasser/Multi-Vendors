

    <div class="card-body">
        <div class="custom-control custom-radio mb-3">
{{--            <span>--}}
{{--                <input @class(['custom-control-input custom-control-input-danger','is-invalid'=>$errors->has('status')]) type="radio" id="Inactive"  name="status" value="Inactive" @checked(old('status',$data['category']['status']) == "Inactive")>--}}
{{--                <label for="Inactive" class="custom-control-label">Inactive</label>--}}
{{--            </span>--}}
{{--            <span class="ml-5">--}}
{{--                <input @class(['custom-control-input custom-control-input-success','is-invalid'=>$errors->has('status')]) type="radio" id="Active" name="status" value="Active" @checked(old('status',$data['category']['status']) == "Active")>--}}
{{--                <label for="Active" class="custom-control-label">Active</label>--}}
{{--                @error('status')--}}
{{--                <div class="text-danger invalid-feedback">--}}
{{--                    {{$message}}--}}
{{--                </div>--}}
{{--                @enderror--}}
{{--            </span>--}}
            <x-dashboard.form.radio name="status" :options="['Active'=>['reference'=>'Active','status'=>'success'],'Inactive'=>['reference'=>'Inactive','status'=>'danger']]" :value="$data['category']['status']" />
        </div>

        <div class="form-group">
            <label for="Name">Category Name</label>
            <x-dashboard.form.input name="name" type="text" label="Category Name"  placeholder="Category Name" :value="$data['category']['name']" />
        </div>
        <div class="form-group">
            <label for="parent" class="form-label">Parent</label>
            <select id="parent" name="parent_id" @class(['form-control','is-invalid'=>$errors->has('parent_id')])>
                <option value="">.........</option>
                @foreach($data['categories'] as $category)
                    <option value="{{$category['id']}}" @selected(old('parent_id',$data['category']['parent_id']) == $category['id']) >{{$category['name']}}</option>
                @endforeach
            </select>
            @error('parent_id')
            <div class="text-danger invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Category Description</label>
            <textarea @class(['form-control','is-invalid'=>$errors->has('description')]) name="description" id="description" placeholder="Category Description">{{old('description',$data['category']['description'])}}</textarea>
        </div>
        @error('description')
        <div class="text-danger invalid-feedback">
            {{$message}}
        </div>
        @enderror
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
