@extends('layout.base')

@section('title')
    Albums
@endsection

@section('content')
    <section class="section albums">
        <div class="container">
            <div class="albums-head">
                <h1 class="albums-head_title">Albums</h1>
                <div class="albums-head_navigation">
                    <button @click="showPopUp" class="btn btn-primary">Voeg toe</button>
                </div>
            </div>

            <div class="is-line"></div>

            <div class="albums-list">
                @foreach($albums as $album)
                    <a href="{{ route('album.show', [$album->albumId]) }}">
                        <div class="album-item">
                            <div class="album-image">
                                <div class="album-image_inner" @if($album->imageId) style="background-image: url('{{ $album->imageId }}')" @endif></div>
                            </div>
                            <p class="album-title">
                                {{ $album->title }}
                                @if($album->privacyStatus)
                                    <i class="fas fa-lock"></i>
                                @else
                                    <i class="fas fa-globe-americas"></i>
                                @endif
                            </p>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <popup v-cloak>
        @include('albums.create')
    </popup>
@endsection
