@extends('layout.base')

@section('title', 'Homepage')

@section('content')
    <section class="page-header_home">
        <div class="header_block">
            <h1 id="page-header_primary">
                <span class="page-header_title">Explore the world</span>
                <span class="page-header_sub">“Life can be expressed in a picture”</span>
            </h1>
        </div>
    </section>
    <section class="image-list">
            <album :image-list="{{ $pictures }}" inline-template v-cloak>
                <div class="image-list_body album-list container">
                    <img v-for="(image, key) in images" v-bind:src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" />
                </div>
            </album>
{{--            @foreach($pictures as $picture)--}}
{{--                <img class="is-fade-in" src="/storage/{{ $picture->image }}" @click=" alert('test') ">--}}
{{--            @endforeach--}}

    </section>

    <fullscreen-image :edit-info="0" :not-linked-to-album="1"></fullscreen-image>
@endsection
