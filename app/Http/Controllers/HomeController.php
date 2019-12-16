<?php

namespace App\Http\Controllers;

use App\Album;
use App\User;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
            })->get()->random($amountofRows);
        } else {
            $pictures = Picture::whereHas('album', function($q){
                $q->where('privacyStatus', '=', null);
            })->get()->random(100);
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
        ]);
    }

    public function getProfilePicture() {
        return response()->json(['profilePicture'=>auth()->user()->profile_picture]);
    }

    public function storeProfilePicture(Request $request) {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);
        $result = [];
        $result['profile_picture'] = $request->file('image')->store('profile-picture', 'public');
        User::where('id', '=', auth()->user()->id)->update($result);
        return response()->json(['success'=>true]);
    }
}
