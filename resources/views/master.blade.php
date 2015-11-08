<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MeetUpr</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{!! asset('libs/fontello-71e14bde/css/fontello.css') !!}">
    <link rel="stylesheet" href="{!! asset('libs/slick-1.5.7/slick/slick.css') !!}">
    <link rel="stylesheet" href="{!! asset('libs/slick-1.5.7/slick/slick-theme.css') !!}">
    <link rel="stylesheet" href="{!! asset('libs/select2-3.5.4/select2.css') !!}">
    <link rel="stylesheet" href="{!! asset('libs/select2-3.5.4/select2-bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Alice' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="{!! asset('libs/jquery-1.11.3.min.js') !!}"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    @yield('css')
</head>
<body>

@include('header')
@yield('content')
@include('footer-menu')
@yield('javascript')

<div class="modal-container"></div>

<script>

    $('.notification-seen').click(function() {
        var id = $(this).data('notification-id');

        $.ajax({
            type: "GET",
            url: 'http://localhost:8888/notification/' + id,
            data: {

            },
            success: function(data) {
                if(data == 'empty') {
                    $('.notifications-toggle').html(' ');
                    $('.notifications-toggle').append('<i class="fa fa-bell-o"></i>');
                }
                $('a.notification-seen[data-notification-id="' + id + '"]').toggleClass('notification-unseen');
            },
            dataType: 'json'
        });
    });

</script>


<script src="{!! asset('libs/slick-1.5.7/slick/slick.min.js') !!}"></script>
<script src="{!! asset('libs/bootstrap.min.js') !!}"></script>
<script src="{!! asset('libs/select2-3.5.4/select2.min.js') !!}"></script>
<script src="{!! asset('js/scripts.js') !!}"></script>
<script src="{!! asset('js/scripts11.js') !!}"></script>

{{--@include('profile-modal')--}}
</body>
</html>
