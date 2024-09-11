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
        <div class="card-body">
            <form action="{{route('dashboard.'.$data['section'].'.update')}}" method="post" >
                @csrf
                @method('patch')
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="first_name">First Name</label>
                        <x-dashboard.form.input name="first_name" :value="$data['user']->profile->first_name" />
                    </div>
                    <div class="col-md-6">
                        <label for="last_name">Last Name</label>
                        <x-dashboard.form.input name="last_name" :value="$data['user']->profile->last_name" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="date">Birthday</label>
                        <x-dashboard.form.input name="birthday" type="date" :value="$data['user']->profile->birthday" />
                    </div>
                    <div class="col-md-4 align-content-center ml-5">
                         <x-dashboard.form.radio name="gender" :value="$data['user']->profile->gender" :options="['Male'=>['status'=>'primary','reference'=>'male'],'Female'=>['status'=>'primary','reference'=>'female']]" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="city">City</label>
                        <x-dashboard.form.input name="city" :value="$data['user']->profile->city" />
                    </div>
                    <div class="col-md-4">
                        <label for="state">State</label>
                        <x-dashboard.form.input name="state" :value="$data['user']->profile->state" />
                    </div>
                    <div class="col-md-4">
                        <label for="street">Street</label>
                        <x-dashboard.form.input name="street" :value="$data['user']->profile->street" />
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-md-4">
                        <label for="postal_code">Postal Code</label>
                        <x-dashboard.form.input name="postal_code" :value="$data['user']->profile->postal_code" />
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.form.select name="country" :data="$data['user']->profile->country" :options="$data['countries']" />
                    </div>
                    <div class="col-md-4 ">
                        <x-dashboard.form.select name="local" :data="$data['user']->profile->local" :options="$data['local']" />
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
           </form>
        </div>
    </div>
@endsection
