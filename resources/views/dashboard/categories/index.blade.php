@extends('layouts.dashboard')

@section('content')
    <!-- Main content -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('dashboard.'.$data['section'].'.create')}}" class="btn btn-lg text-primary "><i class="fa fa-plus-circle"></i> New</a>
            </h3>
            <h3 class="card-title">
                <a href="{{route('dashboard.'.$data['section'].'.trash')}}" class="btn btn-lg text-danger "><i class="fa fa-trash"></i> Trash</a>
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
                    <th class="text-center">products_count</th>
                    <th class="text-center">status</th>
                    <th class="text-center">Control</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['categories'] as $key => $category)
                    <tr>
                        <td class="text-center">{{++$key}}</td>
                        <td class="center"><img src="{{asset('assets/images/'.$category['dashboard_image'])}}" class="img-lg img-circle"></td>
                        <td><a href="{{route('dashboard.'.$data['section'].'.show',$category['id'])}}" >{{$category['name']}}</a></td>
                        <td>{{$category['parent']['name']}}</td>
                        <td>{{$category['slug']}}</td>
                        <td>{{$category['description']}}</td>
                        <td>{{$category['products_count']}}</td>
                        <td>{{$category['status']}}</td>
                        <td>
                            <div class="d-flex row justify-content-lg-center">
                                <a href="{{route('dashboard.'.$data['section'].'.edit',$category->id)}}" class="btn text-success "><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn text-danger" data-toggle="modal" data-target="#modal-default{{$category['id']}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="modal fade" id="modal-default{{$category['id']}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning Message</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure You Need To Delete {{$category->name}}
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <form  action="{{route('dashboard.'.$data['section'].'.destroy',$category['id'])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" class="form-control" name="id" value="{{$category['id']}}">
                                                    <button type="submit" class="btn btn-danger">Yes , Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-secondary text-light text-center">There is no Categories</div>
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
