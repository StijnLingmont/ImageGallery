<?php

namespace App\Http\Controllers;

use App\Album;
use App\Picture;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PictureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function store(Request $request) {

        $request->validate([
            'image.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2048'
        ]);

        $round = 0;

        foreach($request->all() as $file) {
            $result = [];
            $result['user_id'] = auth()->user()->id;
            $result['image'] = 'uploaded/' . $result['user_id'] . '_' . $round . '_' . time() . '.' . $file->getClientOriginalExtension();

            $image = Image::make($file->getRealPath());
            $image->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/' . $result['image'] ));

            Picture::create($result);
            $round++;
        }

        return response()->json(['amount'=>count($request->all())]);
    }

    public function index(Request $request) {
        $images = Picture::where('user_id', auth()->user()->id)->get();

        return response()->json(['images'=>$images]);
    }

    public function destroy(Picture $picture) {
        $picture->delete();

        return response()->json(['status'=>'success']);
    }

    public function show(Album $album, Picture $picture) {
        $image = $album->picture()->find($picture['id']);

        $user = User::find($image->user_id);

        return response()->json(['images'=> $image, 'user' => $user]);
    }

    public function detailStore(Request $request, Album $album, Picture $picture) {
        $validate = $request->validate([
            'title' => '',
            'description' => '',
        ]);

        $album->picture()->updateExistingPivot($picture['id'], $validate);

        return response()->json(['status'=> 'success']);
    }
}
