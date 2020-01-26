<?php

namespace App\Http\Controllers;

use App\Album;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Link;

class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'getImages');
    }

    public function index() {
        $albums = Album::where('user_id', '=', auth()->user()->id)
            ->with('picture')->get();

        return view('albums.index', [
            'albums' => $albums
        ]);
    }

    public function show(Album $album) {
        $isChecked = $album->user_id == (auth()->user() ? auth()->user()->id : false);
        if($album->privacyStatus && !$isChecked) {
            return abort(404);
        }

        return view('albums.show', [
            'album' => $album,
            'ownsAlbum' => $isChecked,
        ]);
    }

    public function store(Request $request) {
        $result = $request->validate([
            'title' => ['required', 'max:255'],
            'privacyStatus' => [],
        ]);

        $result['user_id'] = auth()->user()->id;

        Album::create($result);

        return redirect(route('album.index'));
    }

    public function update(Request $request, Album $album) {
        $result = $request->validate([
            'title' => ['required', 'max:255'],
            'privacyStatus' => [],
        ]);

        $result['privacyStatus'] = isset($result['privacyStatus']) ? $result['privacyStatus'] : null;

        $album->update($result);

        return redirect(route('album.index'));
    }

    public function destroy(Album $album) {
        $album->delete();

        return redirect(route('album.index'));
    }

    public function link(Request $request, Album $album) {
        $imageList = $request->validate([
            '*' => 'integer'
        ]);

        foreach($imageList as $image) {
            $album->save();
            $album->picture()->attach($image);
        }

        return response()->json(['status'=>'Stored']);
    }

    public function getImages(Album $album) {
        return $album->picture()->get();
    }

    public function removeLink(Album $album, Picture $picture) {
        $album->picture()->detach($picture);
    }
}
