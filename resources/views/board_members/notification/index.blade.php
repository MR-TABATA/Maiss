@extends('common.base')
@section('title', NotifyConsts::TITLE_INDEX)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{NotifyConsts::TITLE_INDEX}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

<section class="section">

<div class="row">
  <div class="col-lg-12">
    <div class="card info-card sales-card">
      <div class="card-body">
        @foreach($notifications AS $notification)
          <div class="row mt-2">
            <div class="col-md-12"><a href="{{ route('notification-show-board', $notification->id) }}">{{ $notification->title }}</a></div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

</section>

@endsection
