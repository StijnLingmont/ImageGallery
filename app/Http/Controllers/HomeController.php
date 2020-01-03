<?php

namespace App\Http\Controllers;

use \File;
use App\Album;
use App\User;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('dashboard');
    }

    public function index()
    {
        $amountofRows = Picture::whereHas('album', function($q){
            $q->where('privacyStatus', '=', null);
        })->count();
        if($amountofRows < 100) {
            $pictures = Picture::whereHas('album', function($q){
                $q->where('privacyStatus', '=', null);
            })
                ->with('album')
                ->get()
                ->shuffle();
        } else {
            $pictures = Picture::whereHas('album', function($q){
                $q->where('privacyStatus', '=', null);
            })
                ->withPivot('album_id')
                ->get()
                ->random(100)
                ->shuffle();
        }

        $transparentHeader = true;
        return view('index', [
            'transparentHeader' => $transparentHeader,
            'pictures' => $pictures,
        ]);
    }

    public function dashboard() {
        return view('dashboard', [
            'user' => auth()->user(),
            'verify' => auth()->user()->authenticated(),
        ]);
    }

    public function getProfilePicture() {
        return response()->json(['profilePicture'=>auth()->user()->profile_picture]);
    }

    public function storeProfilePicture(Request $request) {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif']
        ]);

        $result = [];
        $result['profile_picture'] = 'profile-picture/' . auth()->user()->id . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

        $image = Image::make($request->file('image')->getRealPath());
        $image->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('storage/' . $result['profile_picture'] ));
        if(auth()->user()->profile_picture != null) {
            File::delete(public_path('storage/' . auth()->user()->profile_picture));
        }

        User::where('id', '=', auth()->user()->id)->update($result);
        return response()->json(['success'=>true]);
    }
}
