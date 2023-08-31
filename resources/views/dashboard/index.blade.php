@extends('common.base')
@section('title', 'トップページ')
@section('css')


@endsection

@section('js')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
      locale: "ja",
      buttonText: {
        today: '今月',
        month: '月',
        list: 'リスト'
      },
      events: [
      @foreach($schedules as $schedule)
      {
        title : '{{ $schedule->name }}',
        start : '{{ $schedule->start_date }}',
        title : '{{ $schedule->event_name }}',
        end : '{{ $schedule->end_date }}',
        url : '{{ $schedule->url }}',
        color : '{{ $schedule->enquete_id ==1 ? NotifyConsts::EVENT_COLOR : EnqueteConsts::EVENT_COLOR }}',
      },
      @endforeach
      ]
    });

    calendar.render();
    });
</script>
@endsection
@section('content')

<div class="pagetitle mb-3">
  <h1>ダッシュボード</h1>
</div><!-- End Page Title -->

<section class="section dashboard">

<div class="row">
  <div class="col-lg-12">
  <div class="card info-card sales-card">
    <div class="card-body">
    <h3 class="fw-normal mb-3 card-title">お知らせ</h3>
      @foreach($notifications['temp'] AS $notification)
      <div class="row mt-2">
        <div class="col-md-12"><a href="{{ route('notification-show', $notification->id) }}">{{ $notification->title }}</a></div>
      </div>
      @endforeach
      @foreach($notifications['permanemt'] AS $notification)
      <div class="row mt-3">
        <div class="col-md-12 h5"><a href="{{ route('notification-show', $notification->id) }}">{{ $notification->title }}</a></div>
      </div>
      @endforeach
    </div>
  </div>
  </div>
</div>
<div class="row">
 <div class="col-lg-12">
   <div class="card info-card sales-card">
     <div class="card-body">
     <h3 class="fw-normal mb-3 card-title">アンケート</h3>
       @foreach($enquetes AS $enquete)
       <div class="row mt-2">
         <div class="col-md-8"><a href="{{ route('enquete-show', $enquete->id) }}">{{ $enquete->title }}</a></div>
         <div class="col-md-4 text-end">{{ $enquete->expired_at }}</div>
       </div>
       @endforeach
     </div>
  </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
  <div class="card info-card sales-card">
    <div class="card-body">
    <h3 class="fw-normal mb-3 card-title">スケジュール</h3>
      <div id="calendar"></div>
    </div>
  </div>
  </div>
</div>

</section>

@endsection
