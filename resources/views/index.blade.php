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
                <div ref="album" class="image-list_body album-list container">
                    <masonry
                        :cols="{default: 3, 700: 2, 400: 1}"
                        :gutter="10"
                    >
                        <fade v-for="(image, key) in limitedImages" :key="key" v-cloak>
                            <img :src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" ref="albumImage" />
                        </fade>
                    </masonry>
                </div>
            </album>
        <lazy-image-check></lazy-image-check>

    </section>

    <fullscreen-image :edit-info="0" :not-linked-to-album="1"></fullscreen-image>
@endsection
