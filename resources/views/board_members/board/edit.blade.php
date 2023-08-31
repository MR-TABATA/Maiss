@extends('common.base')
@section('title', BoardConsts::TITLE_EDIT)
@section('content')

<div class="pagetitle">
  <h1>{{BoardConsts::TITLE_EDIT}}</h1>
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
    <label for="inputText" class="col-md-3 col-form-label">組</label>
    <div class="col-md-7">
      <input type="text" name="team" class="form-control" value="{{$board->team}}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">開始日</label>
    <div class="col-md-7">
      <input type="text" name="start_date" class="form-control" value="{{$board->start_date}}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">満期日</label>
    <div class="col-md-7">
      <input type="text" name="end_date" class="form-control" value="{{$board->end_date}}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">組合員</label>
    <div class="col-md-4">
    <select name="user_id" class="form-select" aria-label="Default select">
      <option selected value="{{$board->user_id}}">{{$board->user->room}} {{$board->user->family_name}} {{$board->user->given_name}}</option>
      @foreach($users AS $key => $user)
      @if( $key > 1)
      <option value="{{$user->id}}">{{$user->room}}号室 {{$user->family_name}} {{$user->given_name}}</option>
      @endif
      @endforeach
    </select>
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
