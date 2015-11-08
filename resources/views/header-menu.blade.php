<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <span>
                    <img src="/img/logo-test.png" alt="">
                </span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="nav navbar-nav navbar-right">
                @if (!\Auth::check())
                        <!-- if NOT logged in -->
                <li><a href="/auth">Sign in with <span class="icon-facebook"></span></a></li>
                @else
                        <!-- if IS logged in -->

                <li><a href="/event">Create event</a></li>
                <li><a href="/events">My Events</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <img height="20" src="{{Auth::user()->avatar}}" class="user-avatar" alt="">
                        {{Auth::user()->name}}<span class="caret"></span>
                    </a>
                        <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#profileModal">User Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/auth/logout">Sign out</a></li>
                    </ul>
                </li>
                @include('notifications')
                @endif

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>