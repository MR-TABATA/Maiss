@extends('common.base')
@section('title', NotifyConsts::TITLE_EDIT)
@section('content')

<div class="pagetitle">
  <h1>{{NotifyConsts::TITLE_EDIT}}</h1>
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
    <label for="inputText" class="col-md-3 col-form-label">タイトル</label>
    <div class="col-md-7">
      <input type="text" name="title" class="form-control" value="{{$notification->title}}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">内容</label>
    <div class="col-md-7">
      <textarea name="content" class="form-control" style="height: 500px">{{$notification->content}}</textarea>
    </div>
  </div>

  <hr />

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">開始日時</label>
    <div class="col-md-7">
      <input type="text" name="start_date" class="form-control" value="{{ !empty($notification->schedules->start_date) ? $notification->schedules->start_date:'' }}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">終了日時</label>
    <div class="col-md-7">
      <input type="text" name="end_date" class="form-control" value="{{!empty($notification->schedules->end_date) ? $notification->schedules->end_date:'' }}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
  <div class="col-md-3"></div>
  <div class="col-md-6">
      <button type="submit" class="btn btn-primary w-25">更新</button>
    </div>
  </div>
</form>
</section>
@endsection
