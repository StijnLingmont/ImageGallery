@extends('layout.base')

@section('title', 'Login')

@section('content')
<section class="login default-forum">
    <div class="container">
        <form class="forum" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="forum-item">
                <label for="email">Email</label>
                <input id="email" class="forum-input @error('email') forum-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="forum-item">
                <label for="password">Password</label>
                <input id="password" class="forum-input @error('password') forum-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="forum-item">
                <input class="forum-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label for="remember">
                    {{ __('Remember Me') }}
                </label>

                <button class="forum-submit btn btn-primary" type="submit">
                    Login
                </button>
            </div>
        </form>

        <div id="password-forgot">
            @if (Route::has('password.request'))
                <a class="forum-button" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            @endif
        </div>
    </div>
</section>
@endsection
