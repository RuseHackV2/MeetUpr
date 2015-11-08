@extends('master')

@section('content')
    <div class="page-banner page-events">
        <div class="page-header-overlay"></div>
        <div class="container">
            <h1 class="page-header">My Events</h1>
        </div>
    </div>

    <div class="container">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-3">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-stacked event-categories" role="tablist">
                        <li role="presentation" class="active"><a href="#hosted" aria-controls="hosted" role="tab" data-toggle="tab">Hosted</a></li>
                        <li role="presentation"><a href="#applied" aria-controls="applied" role="tab" data-toggle="tab">Applied</a></li>
                        <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <!-- Tab panes -->
                    <div class="tab-content event-list">
                        <div role="tabpanel" class="tab-pane active" id="hosted">
                            @foreach($hostedEvents as $event)
                                <div class="panel panel-default event event-hosted">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <span class="event-date pull-right"><span class="fa fa-calendar fa-fw"></span> {{date('d M', strtotime($event->event_date))}}</span>
                                            <a href="/events/{{$event->id}}">{{$event->name}}</a>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="{{$event->boardgame->image}}" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="description">{{$event->description}}</div>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <span class="players-count">
                                                @for($i = 1; $i <= $event->max_player_slots; $i++)
                                                    <i class="fa fa-male {{$i <= $event->playersCount ? 'taken' : 'empty'}}"></i>
                                                @endfor
                                                </span>
{{--                                                <span class="players-count">{{$event->playersCount}}/{{$event->max_player_slots}}</span>--}}
                                                <a href="/events/{{$event->id}}" class="btn btn-info btn-sm">Details <span class="fa fa-angle-double-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applied">
                            @foreach($appliedEvents as $event)
                                <div class="panel panel-default event event-applied">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <span class="event-status pull-right label {{$event->status}}">{{$event->status}}</span>
                                            <span class="event-date pull-right"><span class="fa fa-calendar fa-fw"></span> {{date('d M', strtotime($event->event_date))}}</span>
                                            <a href="/events/{{$event->id}}">{{$event->name}}</a>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            {{--<div class="col-md-3">--}}
                                                {{--<img src="{{$event->boardgame->image}}" alt="">--}}
                                            {{--</div>--}}
                                            <div class="col-md-9">
                                                <div class="description">{{$event->description}}</div>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                {{--<span class="players-count">{{$event->playersCount}}/{{$event->max_player_slots}}</span>--}}
                                                <span class="players-count">
                                                @for($i = 1; $i <= $event->max_player_slots; $i++)
                                                        <i class="fa fa-male {{$i <= $event->playersCount ? 'taken' : 'empty'}}"></i>
                                                    @endfor
                                                </span>
                                                <a href="/events/{{$event->id}}" class="btn btn-default btn-sm">Details <span class="fa fa-angle-double-right"></span></a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div role="tabpanel" class="tab-pane" id="history">
                            @foreach($appliedEvents as $event)
                                <div class="panel panel-default event event-passed">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <span class="event-date pull-right"><span class="fa fa-calendar fa-fw"></span> {{date('d M', strtotime($event->event_date))}}</span>
                                            <a href="/events/{{$event->id}}">{{$event->name}}</a>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            {{--<div class="col-md-3">--}}
                                                {{--<img src="{{$event->boardgame->image}}" alt="">--}}
                                            {{--</div>--}}
                                            <div class="col-md-9">
                                                <div class="description">{{$event->description}}</div>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                {{--<span class="players-count">{{$event->max_player_slots}}</span>--}}
                                                <span class="players-count">
                                                @for($i = 1; $i <= $event->max_player_slots; $i++)
                                                        <i class="fa fa-male {{$i <= $event->playersCount ? 'taken' : 'empty'}}"></i>
                                                    @endfor
                                                </span>
                                                <a href="/events/{{$event->id}}" class="btn btn-default btn-sm">Details <span class="fa fa-angle-double-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection