@extends('common.base')
@section('title', $title)
@section('content')

<div class="pagetitle">
  <h1>{{$title}}</h1>
</div>

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
    <label for="inputText" class="col-md-3 col-form-label">章</label>
    <div class="col-md-7">
      <input type="text" name="chapter" class="form-control" value="{{$rule->chapter}}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">章文</label>
    <div class="col-md-7">
      <input type="text" name="chapter_str" class="form-control" value="{{ $rule->chapter_str }}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">節</label>
    <div class="col-md-7">
      <input type="text" name="section" class="form-control" value="{{ $rule->section }}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">節文</label>
    <div class="col-md-7">
      <input type="text" name="section_str" class="form-control" value="{{ $rule->section_str }}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">条</label>
    <div class="col-md-7">
      <input type="text" name="paragraph" class="form-control" value="{{ $rule->paragraph }}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">条文</label>
    <div class="col-md-7">
      <textarea name="paragraph_text" class="form-control" style="height: 300px">{{ $rule->paragraph_text }}</textarea>
    </div>
  </div>


  <div class="row mb-3">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary px-5">変更</button>
    </div>
  </div>
</form>
</section>
@endsection
