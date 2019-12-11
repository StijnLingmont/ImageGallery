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
                    <button @click="editForm" class="btn btn-primary">Voeg toe</button>
                </div>
            </div>

            <div class="is-line"></div>

            <div class="albums-list">
                @foreach($albums as $album)
                    <div class="album-item">
                        <form action="{{ route('album.destroy', $album->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="remove-album btn btn-delete">X</button>
                        </form>
                        <button @click="editForm({{ $album }})" class="edit-album btn btn-edit"><i class="fas fa-edit"></i></button>

                        <a href="{{ route('album.show', [$album->id]) }}">
                            <div class="album-image">
                                <div class="album-image_inner @if(!$album->picture->count()) default-image @endif" @if($album->picture->count()) style="background-image: url('/storage/{{ $album->picture->first()->image }}')" @endif></div>
                            </div>
                            <p class="album-title">
                                <span>{{ $album->title }}</span>
                                @if($album->privacyStatus)
                                    <i class="fas fa-lock"></i>
                                @else
                                    <i class="fas fa-globe-americas"></i>
                                @endif
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <popup v-cloak>
        <album-form inline-template>
            <section class="inline-forum">
                <form class="forum" method="POST" :action="action">
                    <input v-if="albumId" type="hidden" name="_method" value="patch">
                    @csrf
                    <div class="forum-item">
                        <label for="title">Title</label>
                        <input class="forum-input @error('name') forum-invalid @enderror" id="title" type="text" name="title" value="{{ old('title') }}" v-model="title" required autocomplete="title" autofocus>

                        @error('name')
                        <span class="text-error">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>

                    <div class="forum-item">
                        <label class="switch">
                            <input name="privacyStatus" class="@error('name') forum-invalid @enderror" id="privacyStatus" type="checkbox" value="1" v-model="privacyStatus" autocomplete="title" autofocus>
                            <span class="slider round"></span>
                        </label>
                        <label for="privacyStatus">Private</label>

                        @error('name')
                        <span class="text-error">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="forum-item">
                        <button class="forum-submit btn btn-primary" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </section>
        </album-form>
    </popup>
@endsection
