@extends('layout.base')

@section('title', $album->title)

@section('content')
    <section class="section album">
        <div class="container">
            <div class="album-head">
                <div class="album-name">
                    <h1 class="album-head_title">{{ $album->title }}</h1>
                    <a href="{{ route('album.index') }}" class="back-album btn btn-edit"><i class="fas fa-arrow-left"></i> Back to Albums</a>
                </div>
                @if($ownsAlbum)
                    <div class="album-head_navigation">
                        <button @click="showPopUp" class="btn btn-primary">Add Picture</button>
                    </div>
                @endif
            </div>

            <div class="is-line"></div>

            <div class="album-body">
                <album :album-id="{{ $album->id }}" inline-template v-cloak>
                    <div ref="album" class="album-list">
                        <masonry :cols="{default: 3, 700: 2, 400: 1}" :gutter="10">
                            @if(auth()->user() && ($album->user_id == auth()->user()->id))
                                <owned-image v-for="(image, key) in limitedImages" :key="key" :image="image" :album="{{ $album->id }}">
                                    <img :src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" ref="albumImage" />
                                </owned-image>
                            @else
                                <fade v-for="(image, key) in limitedImages" :key="key">
                                    <img :src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" ref="albumImage" />
                                </fade>
                            @endif
                        </masonry>
                    </div>
                </album>

                <lazy-image-check></lazy-image-check>
            </div>
        </div>
    </section>

    @auth()<image-uploader :album-id="{{ $album->id }}" v-cloak></image-uploader>@endif
    <fullscreen-image :edit-info="{{ $album->checkUser() }}"></fullscreen-image>
@endsection
