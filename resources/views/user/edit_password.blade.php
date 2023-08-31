@extends('common.base')
@section('title', UserConsts::TITLE_EDIT_PASSWORD)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{UserConsts::TITLE_EDIT_PASSWORD}}</h1>
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
      <label for="inputText" class="col-md-3 col-form-label">現在のパスワード</label>
      <div class="col-md-4">
      <input type="password" name="current_pasword" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">新しいパスワード</label>
      <div class="col-md-4">
      <input type="password" name="password" class="form-control">
      <p class="text-danger mt-2">{{UserConsts::PASSWORD_ALLOW}}</p>
      </div>

    </div>

    <div class="row mb-3">
      <label for="inputText" class="col-md-3 col-form-label">新しいパスワード（確認）</label>
      <div class="col-md-4">
      <input type="password" name="password_confirmation" class="form-control">
      <p class="text-danger mt-2">{{UserConsts::PASSWORD_ALLOW}}</p>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-3"></div>
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary w-25">更新する</button>
      </div>
    </div>
  </form>


</section>

@endsection
