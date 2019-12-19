@extends('layout.base')

@section('content')
<section class="login default-forum">
    <div class="container">
        <form class="forum" method="POST" action="{{ route('verification.resend') }}">
            @csrf


            <div class="forum-item">
                <h3>Verify Your Email Address</h3>
                <p>Before proceeding, please check your email for a verification link.</p>
            </div>

            <div class="forum-item">
                <button class="forum-submit btn btn-primary" type="submit">
                    click here to request another
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
