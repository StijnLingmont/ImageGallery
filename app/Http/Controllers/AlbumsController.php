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

        $result['userId'] = auth()->user()->userId;

        Album::create($result);

        return redirect(route('album.index'));
    }
}
