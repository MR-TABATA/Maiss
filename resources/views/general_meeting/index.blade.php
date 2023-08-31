@extends('common.base')
@section('title', '総会')
@section('content')

<div class="pagetitle mb-3">
  <h1>総会一覧</h1>
</div><!-- End Page Title -->

<section class="section">

<div class="row">
  <div class="col-lg-12">
    <div class="card info-card sales-card">
      <div class="card-body">
        @foreach($general_meetings AS $key =>$general_meeting)
          <div class="row mt-2">
            <div class="col-md-2">{{ $general_meeting->title }}</div>
            <div class="col-md-2">{{ $general_meeting->open_date }}</a></div>
            <div class="col-md-2">{{ $general_meeting->place }}</div>
            <div class="col-md-2"><a href="{{ route('meeting_pdf-show', ['id'=>$general_meeting->id,]) }}" target="_blank">総会資料表示（pdf）</a></div>
            <div class="col-md-2"><a href="{{ route('minutes_pdf-show', ['id'=>$general_meeting->id,]) }}" target="_blank">議事録表示（pdf）</a></div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

</section>

@endsection
