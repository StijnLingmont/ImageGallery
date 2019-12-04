@extends('layout.base')

@section('title')
    Albums
@endsection

@section('content')
    <section class="section album">
        <div class="container">
            <div class="album-head">
                <h1 class="album-head_title">{{ $album->title }}</h1>
                <div class="album-head_navigation">
                    <button @click="showPopUp" class="btn btn-primary">Voeg afbeelding toe</button>
                </div>
            </div>

            <div class="is-line"></div>
        </div>
    </section>

    <image-uploader></image-uploader>
@endsection
