<li role="presentation" class="dropdown">
    <a class="dropdown-toggle notifications-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        @if($newCount > 0)
            <i class="fa fa-bell"></i>
        @else
            <i class="fa fa-bell-o"></i>
        @endif
    </a>
    <ul class="dropdown-menu notifications-list">
        @if(count($notifications) > 0)
            @foreach($notifications as $notification)
                <li>
                    <a class="notification notification-seen {{$notification->class}}" href="/events/{{$notification->object_id}}" data-notification-id="{{$notification->id}}">
                        <div>
                            {{$notification->text}} <b>{{$notification->event->name}}</b>
                        </div>
                    </a>
                </li>
            @endforeach
        @else
            <li>
                <a class="notification notification-info">
                    You don't have any notifications yet!
                </a>
            </li>
        @endif
    </ul>
</li>

