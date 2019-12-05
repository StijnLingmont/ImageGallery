<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request) {
        foreach($request->all() as $file){
            $result = [];
            $result['userId'] = auth()->user()->userId;
            $result['image'] = $file->store('/uploaded', 'public');

            Image::create($result);
        }

        return response()->json(['success'=>true]);
    }

    public function index(Request $request) {
        $images = Image::where('userId', auth()->user()->userId)->get();

        return response()->json(['images'=>$images]);
    }
}
