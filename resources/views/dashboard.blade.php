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
                </div>
                <div class="dashboard-buttons">
                    <h1 class="dashboard-title">Dashboard</h1>
                    <div class="dashboard-button-box">
                        <a href="" class="dashboard-button">
                            <img class="dashboard-button_icon" src="/images/picture.svg">
                            <p>Albums</p>
                        </a>
                        <a href="" class="dashboard-button">
                            <img class="dashboard-button_icon" src="/images/picture.svg">
                            <p>Albums</p>
                        </a>
                        <a href="" class="dashboard-button">
                            <img class="dashboard-button_icon"  src="/images/picture.svg">
                            <p>Albums</p>
                        </a>
                        <a href="" class="dashboard-button">
                            <img class="dashboard-button_icon"  src="/images/picture.svg">
                            <p>Albums</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
