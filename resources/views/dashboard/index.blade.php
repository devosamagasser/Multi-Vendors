@extends('layouts.dashboard')

@section('content')
    <!-- Main content -->
    <div class="card">
        <div class="card-header">
{{--            <h3 class="card-title">--}}
{{--                <a href="{{route('committees.create')}}" class="btn btn-lg text-primary "><i class="fa fa-plus-circle"></i> Add Committee</a>--}}
{{--            </h3>--}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
{{--            <table class="table table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th class="text-center">#</th>--}}
{{--                    <th class="text-center">Committe</th>--}}
{{--                    <th class="text-center">Section</th>--}}
{{--                    <th class="text-center">Control</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @forelse($data['committees'] as $key => $committee)--}}
{{--                    <tr>--}}
{{--                        <td class="text-center">{{++$key}}</td>--}}
{{--                        <td>{{$committee['name']}}</td>--}}
{{--                        <td>{{$committee['section']['name']}}</td>--}}
{{--                        <td>--}}
{{--                            <div class="d-flex row justify-content-lg-center">--}}
{{--                                <a href="{{route('committees.edit',$committee->id)}}" class="btn text-success "><i class="fa fa-edit"></i></a>--}}
{{--                                <button type="button" class="btn text-danger" data-toggle="modal" data-target="#modal-default{{$committee['id']}}">--}}
{{--                                    <i class="fa fa-trash"></i>--}}
{{--                                </button>--}}
{{--                                <div class="modal fade" id="modal-default{{$committee['id']}}">--}}
{{--                                    <div class="modal-dialog">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <h4 class="modal-title">Warning Message</h4>--}}
{{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                    <span aria-hidden="true">&times;</span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <div class="modal-body">--}}
{{--                                                Are You Sure You Need To Delete {{$committee->name}}--}}
{{--                                            </div>--}}
{{--                                            <div class="modal-footer justify-content-between">--}}
{{--                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                                                <form  action="{{route('committees.destroy',$committee['id'])}}" method="post">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('delete')--}}
{{--                                                    <input type="hidden" class="form-control" name="id" value="{{$committee['id']}}">--}}
{{--                                                    <button type="submit" class="btn btn-danger">Yes , Delete</button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- /.modal-content -->--}}
{{--                                    </div>--}}
{{--                                    <!-- /.modal-dialog -->--}}
{{--                                </div>--}}
{{--                                <!-- /.modal -->--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @empty--}}
{{--                    <div class="alert alert-secondary text-light text-center">There is no Committees</div>--}}
{{--                @endforelse--}}

{{--                </tbody>--}}
{{--            </table>--}}
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
{{--            <ul class="pagination pagination-sm m-0 float-right">--}}
{{--                <li class="page-item"><a class="page-link" href="#">«</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                <li class="page-item"><a class="page-link" href="#">»</a></li>--}}
{{--            </ul>--}}
        </div>
    </div>
    <!-- /.content -->
@endsection
