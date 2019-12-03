@extends('layout.base')

@section('content')
<section class="register default-forum">
    <div class="container">
        <form class="forum" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="forum-item">
                <label for="name">Name</label>
                <input id="name" class="forum-input @error('email') forum-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('email')
                <span class="text-error">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

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
                <input class="forum-input @error('password') forum-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">

                @error('password')
                <span class="text-error">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="forum-item">
                <label for="password-confirm">Repeat Password</label>
                <input id="password-confirm" type="password" class="forum-input" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="forum-item">
                <button class="forum-submit btn btn-primary" type="submit">
                    Register
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
