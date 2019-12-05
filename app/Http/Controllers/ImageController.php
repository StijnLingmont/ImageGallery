<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request) {
        $result = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif']
        ]);

        $result['userId'] = auth()->user()->userId;
        $result['image'] = $request->file('image')->store('/uploaded', 'public');

        Image::create($result);

        return response()->json(['success'=>true]);
    }

    public function index(Request $request) {
        $images = Image::where('userId', auth()->user()->userId)->get();

        return response()->json(['images'=>$images]);
    }
}
