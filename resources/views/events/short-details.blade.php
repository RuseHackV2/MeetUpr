
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content game-header" style="background-image:url({{$boardGame->image}})">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="game-header-data">
            <h1 class="modal-title">
              <a href="/events/{{$event->id}}">{{$event->name}}</a>
            </h1>
            <small>{{$event->event_date_formated}}</small>
            <h2>We are playing <a href="{{$boardGame->url}}" target="_blank">{{$boardGame->name}}</a></h2>
            @for($i = 1; $i <= $event->max_player_slots; $i++)
              <i class="fa fa-male {{$i <= $event->people_count ? 'taken' : 'empty'}}"></i>
            @endfor
            <p>Created by: <img src="{{ $user->avatar }}" alt=""> {{ $user->name }}</p>

            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                  @if($flagApproveEnable)
                    <a href="/events/{{$event->id}}/apply" class="btn btn-primary pull-right">Apply For Event</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
