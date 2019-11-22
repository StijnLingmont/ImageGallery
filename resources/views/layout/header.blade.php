<navigation :transparent="{{  $transparentHeader ?? 0 }}" inline-template v-cloak>
    <header id="header" :class="{ 'is-transparent': headerColor }">
        <div class="container grid">
            <div id="logo">
                <img id="logo-item" src="{{ asset('assets/img/logo.png') }}" alt="">
            </div>

            <div id="header-menu">
                <ul id="navigation">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Sign up</a>
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
                                    <li class="dropdown-item"><a class="dropdown-link" href="">Account</a></li>
                                    <li class="dropdown-item"><a class="dropdown-link" href="">Albums</a></li>
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

