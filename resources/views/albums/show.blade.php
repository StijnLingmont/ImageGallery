@extends('layout.base')

@section('title', $album->title)

@section('content')
    <section class="section album">
        <div class="container">
            <div class="album-head">
                <h1 class="album-head_title">{{ $album->title }}</h1>
                @if($ownsAlbum)
                    <div class="album-head_navigation">
                        <button @click="showPopUp" class="btn btn-primary">Voeg afbeelding toe</button>
                    </div>
                @endif
            </div>

            <div class="is-line"></div>

            <div class="album-body">
                <album :album-id="{{ $album->id }}" inline-template>
                    <div class="album-list">
                        <img v-for="(image, key) in images" v-bind:src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" />
                    </div>
                </album>
            </div>
        </div>
    </section>

    @auth()<image-uploader :album-id="{{ $album->id }}" v-cloak></image-uploader>@endif
    <fullscreen-image :edit-info="{{ $album->checkUser() }}"></fullscreen-image>
@endsection
