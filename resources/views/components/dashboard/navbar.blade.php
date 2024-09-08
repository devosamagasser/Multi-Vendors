
@foreach($items as $item)
<li class="nav-item">
    <a href="{{route($item['route'])}}" class="nav-link {{ Route::is($item['active']) ? 'active' : '' }}">
        <i class="{{$item['icon']}}"></i>
        <p>
            {{$item['name']}}
        </p>
    </a>
</li>
@endforeach
