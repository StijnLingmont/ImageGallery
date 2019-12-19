<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $result = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = auth()->user()->password;
        if(Hash::check($result['oldpassword'], $hashedPassword)) {
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($result['password']);
            $user->save();
            Auth::logout();
        }

        return redirect(route('login'));
    }
}
