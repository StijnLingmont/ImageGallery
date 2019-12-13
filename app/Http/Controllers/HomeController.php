<?php

namespace App\Http\Controllers;

use App\Album;
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
        //Need to change to dashboard view
        return redirect('/albums');
    }
}
