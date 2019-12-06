<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request) {

        $request->validate([
            'image.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2048'
        ]);

        $round = 0;

        foreach($request->all() as $file) {
            $result = [];
            $result['userId'] = auth()->user()->userId;
            $result['image'] = 'uploaded/' . $result['userId'] . '_' . $round . '_' . time() . '.' . $file->getClientOriginalExtension();

            $image = Image::make($file->getRealPath());
            $image->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('storage/' . $result['image'] ), 20);

            Picture::create($result);
            $round++;
        }

        return response()->json(['amount'=>count($request->all())]);
    }

    public function index(Request $request) {
        $images = Picture::where('userId', auth()->user()->userId)->get();

        return response()->json(['images'=>$images]);
    }
}
