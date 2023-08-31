<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegistRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\Consts\CommonConsts;
use App\Consts\UserConsts;

class UserController extends Controller
{
  public function index() {
    $users = User::all()->sortBy('room');
    return view('user.index', compact('users'));
  }

  public function showRegister() {
    return view('user.register');
  }

  public function register(UserRegistRequest $request) {
    $regist = [
      'family_name'=>$request['family_name'],
      'room'=>$request['room'],
      'given_name'=>$request['given_name'],
      'account'=>$request['account'],
      'email'=>$request['email'],
    ];
    if( !empty($request['password'])) {
      $regist = $regist+ ['password'=>Hash::make($request['password'])];
    }
    if( !empty($request['family_name'])) {
      $regist = $regist+ ['role'=>$request['role']];
    } else {
      $regist = $regist+ ['role'=> 0];
    }
    $user = User::query()->create($regist);

    if ($user) {
        $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
        $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['CREATE_SUCCESS'];
    } else {
        $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
        $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['CREATE_ERROR'];
    }
    return redirect()->route('users-list-board')->with($messageKey, $flashMessage);
  }

  public function show_edit(Request $request, $id) {
    $user = User::find($id);
    return view('user.edit', compact('user'));
  }

  public function edit(UserEditRequest $request, $id) {
    $user = User::find($id);
    $user->family_name = $request->family_name;
    $user->given_name = $request->given_name;
    $user->room = $request->room;
    $user->role = $request->role;
    $user->account = $request->account;
    $user->email = $request->email;
    $User = $user->save();
    if ($User) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
    }
    return redirect()->route('users-list-board')->with($messageKey, $flashMessage);
  }

  public function show_edit_password(Request $request) {
    $user = User::find(Auth::id());
    return view('user.edit_password', compact('user'));
  }
  public function edit_password(UserPasswordRequest $request) {
    $user = User::find(Auth::id());
    $user->password = $request->password;
    $User = $user->save();
    if ($User) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['EDIT_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['EDIT_ERROR'];
    }
    return redirect()->route('show-edit-password')->with($messageKey, $flashMessage);
  }

  public function delete(Request $request, $id) {
    $user = User::find($id);
    $User = $user->delete();
    if ($User) {
      $messageKey =  CommonConsts::FLASH_MESSAGE['SUCCESS_key'];
      $flashMessage = $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['DELETE_SUCCESS'];
    } else {
      $messageKey =  CommonConsts::FLASH_MESSAGE['ERROR_key'];
      $flashMessage =  $user->family_name .' '.$user->given_name.'の'.CommonConsts::FLASH_MESSAGE['DELETE_ERROR'];
    }
    return redirect(route('users-list-board'))->with($messageKey, $flashMessage);
  }
}
