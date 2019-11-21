<header id="header">
    <div class="container grid">
        <div id="logo">
            <img id="logo-item" src="{{ asset('assets/img/logo.png') }}" alt="">
        </div>

        <div id="header-menu">
            <div id="menu-icon" class="menu-button">
                <span></span>
            </div>

            <ul id="navigation">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign up</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
