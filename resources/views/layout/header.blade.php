<navigation :transparent="{{  $transparentHeader ?? 0 }}" inline-template>
    <header id="header" :class="{ 'is-transparent': headerColor }">
        <div class="container grid">
            <div id="logo" @guest class="is-hidden-on-mobile-small" @endguest>
                <a href="{{ route('home') }}"><img id="logo-item" src="{{ asset('assets/img/logo.png') }}" alt="Image Gallery Logo"></a>
            </div>

            <div id="header-menu">
                <ul id="navigation">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i><span class="pc-text">Sign in</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-sign-in-alt"></i><span class=" pc-text">Sign up</span></a>
                        </li>
                    @else
                        <li class="dropdown">
                            <dropdown>
                                <template v-slot:button>
                                    <div id="menu-icon_mobile" class="menu-button">
                                        <span></span>
                                    </div>
                                    <div id="menu-icon_pc">
                                        <div id="nav-avatar" style="background-image: url( @if(auth()->user()->profile_picture != null)'/storage/{{ auth()->user()->profile_picture }}' @else '/assets/img/default-avatar-white.svg' @endif)"></div>
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

        @if(!empty($verify) && Auth::check())
            <div v-if="!transparent" id="verify-message">
                <p>You're not verified yet. Please verify in your mail.</p>
            </div>
        @endif
    </header>
</navigation>

