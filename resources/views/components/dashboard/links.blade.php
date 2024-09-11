@foreach($items as $item)
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route($item['route'])}}" class="nav-link">{{$item['name']}}</a>
    </li>
@endforeach
