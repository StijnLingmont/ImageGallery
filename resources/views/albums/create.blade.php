<section class="inline-forum">
    <form class="forum" method="POST" action="{{ route('album.store') }}">
        @csrf
        <div class="forum-item">
            <label for="title">Title</label>
            <input class="forum-input @error('name') forum-invalid @enderror" id="title" type="text" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

            @error('name')
            <span class="text-error">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="forum-item">
            <label class="switch">
                <input name="privacyStatus" class="@error('name') forum-invalid @enderror" id="privacyStatus" type="checkbox" value="1" autocomplete="title" autofocus>
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
                Make Album
            </button>
        </div>
    </form>
</section>
