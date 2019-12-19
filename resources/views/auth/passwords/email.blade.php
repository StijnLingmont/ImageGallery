@extends('layout.base')

@section('title', 'Password Forget')

@section('content')
    <section class="login default-forum">
        <div class="container">
            <form class="forum" method="POST" action="{{ route('password.email') }}">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

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
                    <button class="forum-submit btn btn-primary" type="submit">
                        Reset password
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
