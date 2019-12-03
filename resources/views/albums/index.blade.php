@extends('layout.base')

@section('title')
    Albums
@endsection

@section('content')
    <section class="section albums">
        <div class="container">
            <div class="albums-head">
                <h1>Albums</h1>
                <a href="{{ route('album.create') }}" class="btn btn-primary">Voeg toe</a>
            </div>

            <div class="is-line"></div>

            <div class="albums-list">

            </div>
        </div>
    </section>
@endsection
