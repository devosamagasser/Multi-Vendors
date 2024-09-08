
@props(['options','name','value'])

@foreach($options as $key => $data)
    <div class="form-check">
        <input class ='custom-control-input custom-control-input-{{$data['status']}}' type="radio" id="{{$key}}"  name="{{$name}}" value="{{$data['reference']}}" @checked(old($name,$value) == $data['reference'])>
        <label for="{{$key}}" class="custom-control-label">{{$key}}</label>
    </div>
@endforeach
