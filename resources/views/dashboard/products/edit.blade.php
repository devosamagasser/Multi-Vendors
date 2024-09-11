@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Update</li>
@endsection

@section('content')

    <x-alert/>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$data['pageTitle']}}</h3>
        </div>
        <form action="{{route('dashboard.'.$data['section'].'.update',$data['product']['id'])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.'.$data['section'].'._form')
        </form>
    </div>
@endsection
