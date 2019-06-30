<nav class="navbar navbar-expand-md fixed-top">
  <div class="container">
    <div class="navbar-translate">
      <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar"></span>
        <span class="navbar-toggler-bar"></span>
        <span class="navbar-toggler-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Jimboy</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            @if (false)
                @if(auth()->check() && auth()->user()->isPremium())
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#create-ad-modal"><i class="nc-icon nc-book-bookmark"></i>Need Ads?</a>
                @endif
            @endif
        </li>
        @auth
            @if(auth()->user()->type !== 2)
                <li class="nav-item">
                    <a href="{{url('admin')}}" class="nav-link"><i class="nc-icon nc-book-bookmark"></i>Dashboard</a>
                </li>
            @endif
        @endif
        <li class="nav-item">
          <a href="{{url('assessment')}}" class="nav-link"><i class="nc-icon nc-book-bookmark"></i>Assessment</a>
        </li>
        <li class="nav-item">
          <a href="{{url('maps')}}" class="nav-link"><i class="nc-icon nc-book-bookmark"></i>Gyms Finder</a>
        </li>
        <li class="nav-item">
          <a href="/posts" class="nav-link"><i class="nc-icon nc-book-bookmark"></i>Blogs</a>
        </li>
        <li class="nav-item">
          @if (Route::has('login'))
            <div class="top-right links">
              @auth
                <div class="dropdown">
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        {{auth()->user()->name}}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li class="dropdown-header">User Settings</li>
                        @if(auth()->user()->type == 1)
                            <a class="dropdown-item" href="/gyms/{{auth()->user()->gym->id}}">Gym Profile</a>
                        @elseif(auth()->user()->type == 2)
                            <a class="dropdown-item" href="/profile">Profile</a>
                        @endif
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#my-subscriptions-modal">My Subscriptions</a>
                        @if (auth()->user()->type == 2)
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#my-reservations-modal">My Reservations</a>
                        @endif
                        <a class="dropdown-item" href="/my_posts">My Posts</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
              @else
                <a href="{{ route('login') }}" class="btn btn-default btn-round">Login</a>
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-default btn-round">Signup</a>
                  @endif
              @endauth
            </div>
          @endif
        </li>
      </ul>
    </div>
  </div>
</nav>
@include('ads.create-modal')
@include('user.partials.my-subscriptions-modal')
@include('user.partials.my-reservations-modal')
