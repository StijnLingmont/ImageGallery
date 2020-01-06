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
                <album :album-id="{{ $album->id }}" inline-template v-cloak>
                    <div class="album-list">
                        <fade v-for="(image, key) in limitedImages" :key="key">
                            <img :src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" ref="albumImage" />
                        </fade>
                    </div>
                </album>

                <lazy-image-check></lazy-image-check>
            </div>
        </div>
    </section>

    @auth()<image-uploader :album-id="{{ $album->id }}" v-cloak></image-uploader>@endif
    <fullscreen-image :edit-info="{{ $album->checkUser() }}"></fullscreen-image>
@endsection
