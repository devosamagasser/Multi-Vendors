<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if($unreadcount)
            <span class="badge badge-warning navbar-badge">{{$unreadcount}}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{$unreadcount}} Notifications</span>
        @foreach($notifications as $notification)
        <div class="dropdown-divider"></div>
        <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}" class="dropdown-item @if($notification->unread()) bg-primary @endif">
            <i class="{{$notification->data['icon']}} mr-2"></i> {{$notification->data['body']}}
            <span class="float-right text-muted text-sm">{{$notification->created_at->longAbsoluteDiffForHumans()}}</span>
        </a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>


{{--<div class="dropdown-divider"></div>--}}
{{--<a href="#" class="dropdown-item">--}}
{{--    <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--    <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--</a>--}}
{{--<div class="dropdown-divider"></div>--}}
{{--<a href="#" class="dropdown-item">--}}
{{--    <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--    <span class="float-right text-muted text-sm">2 days</span>--}}
{{--</a>--}}
