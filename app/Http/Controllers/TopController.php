<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TopController extends Controller
{
  public function showLogin() {
     return view('top.signin');
  }

  public function signin(Request $request) {
    $credentials = $request->validate([
    'account' => ['required'],
    'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    return redirect()->intended('dashboard');
    }

    return back();
  }

  public function signout() {
     Auth::logout();
     return redirect('/');
  }

}
