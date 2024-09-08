@props([
    'name',
    'type' => 'text',
    'value'=> ''
])

<div class="form-group">
    <input type="{{$type}}"
        name="{{$name}}"
        value="{{old($name,$value)}}"
        id="{{$name}}"
{{--    @class(['form-control','is-invalid'=>$errors->has($name)])--}}
       {{$attributes->class([
        'form-control',
        'is-invalid'=>$errors->has($name)
        ])}}>

    @error($name)
    <div class="text-danger invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>


