@extends('common.base')
@section('title', UserConsts::TITLE_EDIT)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{UserConsts::TITLE_EDIT}}</h1>
</div><!-- End Page Title -->

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
      <select name="role" class="form-select">
        @foreach(UserConsts::ROLE_LIST AS $key => $value)
          @if( $key >= 1)
            @if( $key == $user->role)
              <option value="{{$key}}" selected>{{$value}}</option>
            @else
              <option value="{{$key}}">{{$value}}</option>
            @endif
          @endif
        @endforeach
      </select>
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">部屋番号</label>
      <div class="col-md-4">
      <input type="text" name="room" class="form-control" value="{{ $user->room }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">名前（姓）</label>
      <div class="col-md-4">
      <input type="text" name="family_name" class="form-control" value="{{ $user->family_name }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">名前（名）</label>
      <div class="col-md-4">
      <input type="text" name="given_name" class="form-control" value="{{ $user->given_name }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">アカウント（ログイン用）</label>
      <div class="col-md-4">
      <input type="text" name="account" class="form-control" value="{{ $user->account }}">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputEmail" class="col-md-3 col-form-label">メールアドレス</label>
      <div class="col-md-4">
      <input type="email" name="email" class="form-control" value="{{ $user->email }}">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">更新する</button>
      </div>
    </div>
  </form>


</section>

@endsection
