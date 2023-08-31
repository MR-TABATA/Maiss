@extends('common.base')
@section('title', UserConsts::TITLE_REGIST)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{UserConsts::TITLE_REGIST}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<section class="section">

  <form action="" method="post">
    @csrf
    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">役割</label>
      <div class="col-md-4">
      <select name="role" class="form-select" aria-label="Default select">
        <option selected value="">選択ください</option>
        @foreach(UserConsts::ROLE_LIST AS $key => $value)
        <option value="{{$key}}">{{$value}}</option>
        @endforeach
      </select>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">部屋番号</label>
      <div class="col-md-4">
      <input type="text" name="room" class="form-control" value="{{old('room') }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">名前（姓）</label>
      <div class="col-md-4">
      <input type="text" name="family_name" class="form-control" value="{{old('family_name') }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">名前（名）</label>
      <div class="col-md-4">
      <input type="text" name="given_name" class="form-control" value="{{old('given_name') }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">アカウント（ログイン用）</label>
      <div class="col-md-4">
      <input type="text" name="account" class="form-control" value="{{old('account') }}">
      <p class="text-danger mt-2">{{UserConsts::ACCOUNT_ALLOW}}</p>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputEmail" class="col-md-3 col-form-label">メールアドレス</label>
      <div class="col-md-4">
      <input type="email" name="email" class="form-control" value="{{old('email') }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputPassword" class="col-md-3 col-form-label">パスワード</label>
      <div class="col-md-4">
      <input type="password" name="password" class="form-control" value="{{old('password') }}">
      <p class="text-danger mt-2">{{UserConsts::PASSWORD_ALLOW}}</p>
      </div>
    </div>


    <div class="row mb-3">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary w-25">登録</button>
      </div>
    </div>
  </form>


</section>

@endsection
