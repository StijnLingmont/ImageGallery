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

            <div class="album-body">
                <album :album-id="{{ $album->id }}"></album>
            </div>
        </div>
    </section>

    <image-uploader :album-id="{{ $album->id }}" v-cloak></image-uploader>
    <fullscreen-image :edit-info="{{ $album->checkUser() }}"></fullscreen-image>
@endsection
