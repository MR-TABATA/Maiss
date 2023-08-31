@extends('common.base')
@section('title', GeneralMeetingConsts::TITLE_REGIST)
@section('content')

<div class="pagetitle">
  <h1>{{GeneralMeetingConsts::TITLE_REGIST}}</h1>
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
<form method="POST" action="" enctype="multipart/form-data">
  @csrf

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">標題</label>
    <div class="col-md-7">
      <input type="text" name="title" class="form-control" value="{{ old('title') }}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">開催日時</label>
    <div class="col-md-7">
      <input type="text" name="open_date" class="form-control" value="{{ old('open_date') }}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">開催場所</label>
    <div class="col-md-7">
      <input type="text" name="place" class="form-control" value="{{ old('place') }}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">総会資料</label>
    <div class="col-lg-7">
      <input type="file" id="file" name="meeting_pdf" class="form-control" value=""/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">議事録</label>
    <div class="col-lg-7">
      <input type="file" id="file" name="minutes_pdf" class="form-control" />
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary w-25">新規登録</button>
    </div>
  </div>
</form>
</section>
@endsection
