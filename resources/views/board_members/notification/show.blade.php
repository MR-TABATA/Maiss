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
          @if( !empty($notification->schedules->start_date) && !empty($notification->schedules->start_date) )
          <p>{{ $notification->schedules->start_date }}　〜　{{ $notification->schedules->end_date }}</p>
          @endif
          <p class="lh-lg" style="text-align: justify;">{!! nl2br(e($notification->content)) !!}</p>
        </div>
        @can('board')
        <div class="card-footer bg-light">
          <a type="button" href="{{ route('notification-show-edit-board', $notification->id) }}" class="btn btn-success px-5"><i class="bi bi-pencil-square"></i>　編集</a>
          <a type="button" href="{{ route('notification-delete-board', $notification->id) }}" class="btn btn-danger px-5" onclick="return confirm('{{$notification->title}}を削除します。よろしいですか？')"><i class="bi bi-trash"></i>　削除</a>
        </div>
        @endcan
      </div>
    </div>
  </div>
</section>
@endsection
