<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumsController extends Controller
{
    public function index() {
        $albums = Album::all();

        return view('albums.index', [
            'albums' => $albums
        ]);
    }

    public function show(Album $album) {
        return view('albums.show', [
            'album' => $album
        ]);
    }

    public function store(Request $request) {
        $result = $request->validate([
            'title' => ['required', 'max:100'],
            'privacyStatus' => [],
        ]);

        $result['user_id'] = auth()->user()->id;

        Album::create($result);

        return redirect(route('album.index'));
    }

    public function update(Request $request, Album $album) {
        $result = $request->validate([
            'title' => ['required', 'max:100'],
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
            $album->pictures()->attach($image);
        }

        return response()->json(['status'=>'Stored']);
    }

    public function getImages(Album $album) {
        return $album->pictures()->get();
    }
}
