@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">{{$data['category']['name']}}</li>
@endsection

@section('content')

    <x-alert/>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a href="{{URL::previous()}}" class="btn btn-lg text-primary "><i class="fa fa-fast-backward"></i> Back</a>
            </h3>
        </div>
        <div class="card-body">
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
            {{ $data['products']->withQueryString()->links() }}

        </div>
    </div>
@endsection
