<navigation :transparent="{{  $transparentHeader ?? 0 }}" inline-template v-cloak>
    <header id="header" :class="{ 'is-transparent': headerColor }">
        <div class="container grid">
            <div id="logo">
                <a href="{{ route('home') }}"><img id="logo-item" src="{{ asset('assets/img/logo.png') }}" alt="Image Gallery Logo"></a>
            </div>

            <div id="header-menu">
                <ul id="navigation">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i><span class="pc-text is-hidden-on-mobile">Sign in</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-sign-in-alt"></i><span class=" pc-text is-hidden-on-mobile">Sign up</span></a>
                        </li>
                    @else
                        <li class="dropdown">
                            <dropdown>
                                <template v-slot:button>
                                    <div id="menu-icon_mobile" class="menu-button">
                                        <span></span>
                                    </div>
                                    <div id="menu-icon_pc">
                                        <div id="nav-avatar"></div>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </template>
                                <template>
                                    <li class="dropdown-item"><a class="dropdown-link" href="{{ route('dashboard') }}">Account</a></li>
                                    <li class="dropdown-item"><a class="dropdown-link" href="{{ route('album.index') }}">Albums</a></li>
                                    <li class="dropdown-item">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="dropdown-link" type="submit">Logout</button>
                                        </form>
                                    </li>
                                </template>
                            </dropdown>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </header>
</navigation>

