<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $albums = Album::where('user_id', '=', auth()->user()->id)
            ->with('picture')->get();

        return view('albums.index', [
            'albums' => $albums
        ]);
    }

    public function show(Album $album) {
        if($album->privacyStatus && $album->user_id != auth()->user()->id) {
            return redirect(route('home'));
        }

        return view('albums.show', [
            'album' => $album,
        ]);
    }

    public function store(Request $request) {
        $result = $request->validate([
            'title' => ['required', 'max:18'],
            'privacyStatus' => [],
        ]);

        $result['user_id'] = auth()->user()->id;

        Album::create($result);

        return redirect(route('album.index'));
    }

    public function update(Request $request, Album $album) {
        $result = $request->validate([
            'title' => ['required', 'max:18'],
            'privacyStatus' => [],
        ]);

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
}
