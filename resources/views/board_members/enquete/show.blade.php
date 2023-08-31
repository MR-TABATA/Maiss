@extends('common.base')
@section('title', EnqueteConsts::TITLE_SHOW)
@section('content')

<div class="pagetitle">
  <h1>{{EnqueteConsts::TITLE_SHOW}}</h1>
</div>

@include('common.flash_message')

<section class="section">
  <div class="row align-items-top">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$enquete->title}}</h5>

            @if($enquete->expired_at <= now())
              <div class="alert alert-success mt-3">
              @foreach ($aggregated_items AS $aggregated_item)
                <div class="row">
                  <div class="col-md-3">{{ $aggregated_item->option }}</div>
                  <div class="col-md-3">{{ $aggregated_item->total }}</div>
                </div>
              @endforeach
              <hr />

              @foreach ($answer AS $ans)
                <div class="row mt-3">
                  <div class="col-md-12">{!! nl2br(e($ans->comment)) !!}</div>
                </div>
                <hr />
              @endforeach
              </div>

            @endif

          <p class="lh-lg" style="text-align: justify;">{!! nl2br(e($enquete->detail)) !!}</p>
          <p>開始：{{$enquete->start_at}}</p>
          <p>〆切：{{$enquete->expired_at}}</p>
          @if($enquete->expired_at > now())
            @foreach ($aggregated_items AS $aggregated_item)
            <div class="row p-1">
              <div class="col-md-6 border-bottom">{{ $aggregated_item->option }}</div>
              <div class="col-md-1 border-bottom">{{ $aggregated_item->total }}</div>
            </div>
            @endforeach

            <p class="mt-5">以下、コメント</p>
            @foreach ($answer AS $ans)
            <div class="row mt-3">
              <div class="col-md-12 lh-lg">{!! nl2br(e($ans->comment)) !!}</div>
            </div>
            <hr />
            @endforeach
          @endif

        </div>

        <div class="card-footer bg-light">
          @if(  $enquete->start_at > now() )
            <a type="button" href="{{ route('enquete-show-edit-board', $enquete->id) }}" class="btn btn-success px-5"><i class="bi bi-pencil-square"></i>　編集</a>
            <a type="button" href="{{ route('enquete-delete-board', $enquete->id) }}" class="btn btn-danger px-5" onclick="return confirm('{{$enquete->title}}を削除します。よろしいですか？')"><i class="bi bi-trash"></i>　削除</a>
          @else
            <button type="button" href="#" class="btn btn-success px-5" disabled><i class="bi bi-pencil-square"></i>　編集</button>
            <button type="button" href="#" class="btn btn-danger px-5" disabled><i class="bi bi-trash"></i>　削除</button>
          @endif
        </div>

      </div>
    </div>
  </div>
</section>
@endsection
