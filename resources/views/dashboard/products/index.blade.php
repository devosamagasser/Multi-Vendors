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
                    <th class="text-center">image</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">description</th>
                    <th class="text-center">categories</th>
                    <th class="text-center">store</th>
                    <th class="text-center">price</th>
                    <th class="text-center">status</th>
                    <th class="text-center">options</th>
                    <th class="text-center">rate</th>
                    <th class="text-center">created_at</th>
                    <th class="text-center">Control</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['products'] as $key => $product)
                    <tr>
                        <td class="text-center">{{++$key}}</td>
                        <td class="center"><img src="{{asset('assets/images/'.$product['dashboard_image'])}}" class="img-lg img-circle"></td>
                        <td>{{$product['name']}}</td>
                        <td>{{$product['slug']}}</td>
                        <td>{{$product['description']}}</td>
                        <td>{{$product['category']['name']}}</td>
                        <td>{{$product['store']['name']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['status']}}</td>
                        <td>{{$product['options']}}</td>
                        <td>{{$product['rate']}}</td>
                        <td>{{$product['created_at']}}</td>
                        <td>
                            <div class="d-flex row justify-content-lg-center">
                                <a href="{{route('dashboard.'.$data['section'].'.edit',$product->id)}}" class="btn text-success "><i class="fa fa-edit"></i></a>
                                <x-dashboard.model name="delete-{{$product['id']}}" status="danger" icon="fa fa-trash" :action="route('dashboard.'.$data['section'].'.destroy',$product['id'])" message="Are You Sure You Need To Delete {{$product->name}}" >
                                    @method('delete')
                                    <button type="submit" class="btn btn-primary">Yes , Delete</button>
                                </x-dashboard.model>
                                <!-- /.modal -->
                            </div>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-secondary text-light text-center">There is no Products</div>
                @endforelse

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $data['products']->withQueryString()->appends(['search' => 1])->links() }}
        </div>
    </div>
    <!-- /.content -->
@endsection
