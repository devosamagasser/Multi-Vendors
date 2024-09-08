<div>
    @if($errors->any)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger w-25 text-center mx-auto my-2">{{$error}}</div>
        @endforeach
    @endif
</div>

