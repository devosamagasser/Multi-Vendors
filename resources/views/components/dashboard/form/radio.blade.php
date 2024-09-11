
@props(['options','name','value'])

<div class="for-control">
@foreach($options as $key => $data)
    <span class="mr-5">
        <input class ='custom-control-input custom-control-input-{{$data['status']}}' type="radio" id="{{$key}}"  name="{{$name}}" value="{{$data['reference']}}" @checked(old($name,$value) == $data['reference'])>
        <label for="{{$key}}" class="custom-control-label">{{$key}}</label>
    </span>
@endforeach
</div>
