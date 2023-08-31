@extends('common.base')
@section('title', GeneralMeetingConsts::TITLE_INDEX)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{GeneralMeetingConsts::TITLE_INDEX}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

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
            <div class="col-md-2">
              @if($general_meeting->meeting_filename)
                <a href="{{ route('meeting_pdf-show', ['id'=>$general_meeting->id,]) }}" target="_blank">総会資料表示（pdf）</a>
              @else
                未アップロード
              @endif
            </div>
            <div class="col-md-2">
            @if($general_meeting->minutes_filename)
              <a href="{{ route('minutes_pdf-show', ['id'=>$general_meeting->id,]) }}" target="_blank">議事録表示（pdf）</a>
            @else
             未アップロード
            @endif
            </div>
            <div class="col-md-2">
              <a href="{{ route('general_meeting-edit-board', $general_meeting->id) }}"><i class="bi bi-pencil-square"></i> 更新</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

</section>

@endsection
