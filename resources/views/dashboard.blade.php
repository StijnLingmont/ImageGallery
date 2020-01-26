@extends('layout.base')

@section('title', 'Dashboard')

@section('content')
    <section class="section dashboard">
        <div class="container">
            <div class="dashboard-head">
                <profile-picture>
                </profile-picture>
            </div>
            <div class="is-line"></div>
            <div class="dashboard-body grid">
                <div class="dashboard-profile">
                    <h1 class="dashboard-title">Account</h1>
                    <p class="dashboard-item"><span class="is-bold">Naam:</span> {{ auth()->user()->name }}</p>
                    <p class="dashboard-item"><span class="is-bold">Email:</span> {{ auth()->user()->email }}</p>
                    <p class="dashboard-item"><span class="is-bold">Created at:</span> {{ date('d-m-Y', strtotime(auth()->user()->created_at)) }}</p>
                    <change-password inline-template>
                        <div class="change-password">
                            <button @click="show" class="btn btn-edit">Change Password</button>
                            <form method="post" action="{{ route('password.update') }}" class="change-password_form" ref="form">
                                @csrf

                                <div class="change-password_input">
                                    <label for="oldpassword">Old Password:</label>
                                    <input id="oldpassword" name="oldpassword" type="password">
                                </div>

                                <div class="change-password_input">
                                    <label for="password">New Password:</label>
                                    <input id="password" name="password" type="password">
                                </div>

                                <div class="change-password_input">
                                    <label for="password-confirm">Confirm Password:</label>
                                    <input id="password-confirm" name="password_confirmation" type="password">
                                </div>

                                <div class="change-password_input">
                                    <button type="submit" class="btn btn-primary">Change</button>
                                </div>
                            </form>
                        </div>
                    </change-password>
                </div>
                <div class="dashboard-buttons">
                    <h1 class="dashboard-title">Dashboard</h1>
                    <div class="dashboard-button-box">
                        <a href="{{ route('album.index') }}" class="dashboard-button">
                            <img class="dashboard-button_icon" src="/images/picture.svg">
                            <p>Albums</p>
                        </a>
                        <a href="{{ route('home') }}" class="dashboard-button">
                            <img class="dashboard-button_icon" src="/images/home.svg">
                            <p>Homepage</p>
                        </a>
                        <a href="{{ route('privacy-policy') }}" class="dashboard-button">
                            <img class="dashboard-button_icon"  src="/images/privacy.svg">
                            <p>Privacy Policy</p>
                        </a>
                        <form action="{{ route('logout') }}" method="post" class="dashboard-button">
                            @csrf
                            <button type="submit">
                                <img class="dashboard-button_icon"  src="/images/logout.svg">
                                <p>Logout</p>
                            </button>
                        </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
