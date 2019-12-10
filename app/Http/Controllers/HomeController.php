<?php

namespace App\Http\Controllers;

use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $amountofRows = Picture::all()->count();
        if($amountofRows < 100) {
            $pictures = Picture::all()->random($amountofRows);
        } else {
            $pictures = Picture::all()->random(100);
        }


        $transparentHeader = true;
        return view('index', [
            'transparentHeader' => $transparentHeader,
            'pictures' => $pictures,
        ]);
    }

    public function dashboard() {
        return view('dashboard');
    }
}
