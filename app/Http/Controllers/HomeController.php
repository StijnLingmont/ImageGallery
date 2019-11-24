<?php

namespace App\Http\Controllers;

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
        $transparentHeader = true;
        return view('index', [
            'transparentHeader' => $transparentHeader,
        ]);
    }

    public function dashboard() {
        return view('dashboard');
    }
}
