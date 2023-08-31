@extends('common.base')
@section('title', NotifyConsts::TITLE_SHOW)
@section('content')

<div class="pagetitle">
  <h1>{{NotifyConsts::TITLE_SHOW}}</h1>
</div>

<section class="section">
  <div class="row align-items-top">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$notification->title}}</h5>
          <p>{{ $notification->schedules->start_date }}　〜　{{ $notification->schedules->end_date }}</p>
          <p class="lh-lg mt-3" style="text-align: justify;">{!! nl2br(e($notification->content)) !!}</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
