@extends('layouts.dashboard')

@section('content')
    <!-- Main content -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{URL::previous()}}" class="btn btn-lg text-primary "><i class="fa fa-fast-backward"></i> Back</a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="get" action="{{URL::current()}}">
                <div class="mb-3 row">
                    <div class="mb-3 col-sm-6 col-md-8 row">
                        <div class="mb-3 col-4">
                            <x-dashboard.form.input name="name" :value="request('name')" placeholder="Filter By Name"/>
                        </div>
                        <div class="mb-3 col-2">
                            <select id="status" class="form-control" name="status">
                                <option value="">All</option>
                                <option value="Active" @selected(request('status') == "Active") >Active</option>
                                <option value="Inactive" @selected(request('status') == "Inactive") >Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-3 col-md-1">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                        <div class="col-sm-3 col-md-2">
                            @if(request('name'))
                                <a href="{{URL::current()}}" class="btn btn-secondary w-100">Remove Filter</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Cover</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Parent</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">description</th>
                    <th class="text-center">Deleted at</th>
                    <th class="text-center">Control</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['categories'] as $key => $category)
                    <tr>
                        <td class="text-center">{{++$key}}</td>
                        <td class="center"><img src="{{asset('assets/images/'.$category['dashboard_image'])}}" class="img-lg img-circle"></td>
                        <td>{{$category['name']}}</td>
                        <td>{{$category['parent_name']}}</td>
                        <td>{{$category['slug']}}</td>
                        <td>{{$category['description']}}</td>
                        <td>{{$category['deleted_at']}}</td>
                        <td>
                            <div class="d-flex row justify-content-lg-center">
                                <x-dashboard.model name="restore-{{$category['id']}}" status="primary" icon="fa fa-trash-restore" :action="route('dashboard.'.$data['section'].'.restore',$category['id'])" message="Are You Sure You Need To Restore {{$category->name}}" >
                                    <form action="{{route('dashboard.categories.restore',$category['id'])}}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-primary">Yes , Restore</button>
                                    </form>
                                </x-dashboard.model>

                                <x-dashboard.model name="kill-{{$category['id']}}" status="danger" icon="fa fa-trash" :action="route('dashboard.'.$data['section'].'.kill',$category['id'])" message="Are You Sure You Need To Delete {{$category->name}} For Ever" >
                                    <form action="{{route('dashboard.categories.kill',$category['id'])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Yes , Delete</button>
                                    </form>
                                </x-dashboard.model>
                            </div>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-secondary text-light text-center">There is no Committees</div>
                @endforelse

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $data['categories']->withQueryString()->appends(['search' => 1])->links() }}

        </div>
    </div>
    <!-- /.content -->
@endsection
