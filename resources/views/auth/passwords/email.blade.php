@extends('layout.base')

@section('title', 'Password Forget')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
