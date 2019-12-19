@extends('layout.base')

@section('title', 'Password Forget')

@section('content')
    <section class="login default-forum">
        <div class="container">
            <form class="forum" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="forum-item">
                    <label for="email">Email</label>
                    <input id="email" class="forum-input @error('email') forum-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="forum-item">
                    <label for="password">Password</label>
                    <input id="password" class="forum-input @error('password') forum-invalid @enderror" type="password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                    @error('password')
                    <span class="text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="forum-item">
                    <label for="password-confirm">Repeat Password</label>
                    <input id="password-confirm" class="forum-input" type="password" name="password_confirmation" required autocomplete="password-confirm" autofocus>
                </div>


                <div class="forum-item">
                    <button class="forum-submit btn btn-primary" type="submit">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

