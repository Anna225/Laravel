<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light custom-nav fixed-top @if( ! isset($menu_type) ) header-bg @endisset">
    <div class="container">
        <a class="navbar-brand logo-brand" href="{{ route('home') }}"> <img src="{{ asset(getmetaValue('site_logo')) }}" alt="Securtac Logo Image" width="85"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            @if ( Auth::guard()->check() )

                <form class="form-inline my-2 my-lg-0 ml-auto">
                    <a href="{{ route('refer') }}" class="btn btn-primary my-2 my-sm-0"><i class="icon-friends mr-2"></i>Refer a
                        Friend</a>
                </form>
                <div class="btn-group">
                    <button type="button" class="text-white dropdown-toggle no-mw pr-0 ml-3" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right cus-dropdown">
                        <a href="{{ route('page', 'faq') }}"><button class="dropdown-item" type="button"><i class="icon-faq mr-3"></i>FAQ</button></a>
                        <a href="{{ route('user.resources') }}"><button class="dropdown-item" type="button"><i class="icon-document mr-3"></i>Resources</button></a>
                        <a href="{{ route('user.dashboard') }}"><button class="dropdown-item" type="button"><i class="icon-book mr-3"></i>My
                                Courses</button></a>
                        <a href="{{ route('myaccount') }}"><button class="dropdown-item" type="button"><i class="icon-user mr-3"></i>My
                                Account</button></a>
                        <a href="">
                            <button class="dropdown-item" type="button" 
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="icon-logout mr-3"></i>Logout
                            </button>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @else
                <form class="form-inline my-2 my-lg-0 ml-auto">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary-our btn-sml my-2 my-sm-0">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sml my-2 my-sm-0">Register</a>
                </form>
            @endif

        </div>    
    </div>
</nav>