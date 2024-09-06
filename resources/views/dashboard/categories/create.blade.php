@extends('layouts.dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

    @if($errors->any)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger w-25 text-center mx-auto my-2">{{$error}}</div>
        @endforeach
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$data['pageTitle']}}</h3>
        </div>
        <form action="{{route('dashboard.'.$data['section'].'.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('dashboard.categories._form')
        </form>
    </div>
@endsection
