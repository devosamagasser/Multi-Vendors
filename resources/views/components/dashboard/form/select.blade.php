<label>{{$label}}</label>
<select name="{{$name}}" class="form-control">
    @foreach($options as $key => $value)
        <option value="{{$key}}" @selected($data == $key)>{{$value}}</option>
    @endforeach
</select>
