@extends('layouts.dashboard')

@section('content')
    <!-- Main content -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{route('dashboard.'.$data['section'].'.create')}}" class="btn btn-lg text-primary "><i class="fa fa-plus-circle"></i> Add Category</a>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Cover</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Parent</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">description</th>
                    <th class="text-center">status</th>
                    <th class="text-center">Control</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['categories'] as $key => $category)
                    <tr>
                        <td class="text-center">{{++$key}}</td>
                        <td>{{asset('assets\images\\'.$category['dashboard_image'])}}<img src="{{asset('assets/images/'.$category['dashboard_image'])}}" ></td>
                        <td>{{$category['name']}}</td>
                        <td>{{$category['parent_id']}}</td>
                        <td>{{$category['slug']}}</td>
                        <td>{{$category['description']}}</td>
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
                    <div class="alert alert-secondary text-light text-center">There is no Committees</div>
                @endforelse

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>
    </div>
    <!-- /.content -->
@endsection
