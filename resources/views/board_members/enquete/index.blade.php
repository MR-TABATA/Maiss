@extends('common.base')
@section('title', EnqueteConsts::TITLE_INDEX)
@section('content')

<div class="pagetitle">
  <h1>{{EnqueteConsts::TITLE_INDEX}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h3 class="fw-normal mb-3 card-title">
            アンケート一覧
          </h3>
            @foreach($enquetes AS $enquete)
              <div class="row mt-2">
                <div class="col-md-1">
                @if( $enquete->expired_at < now() )
                  <span class="badge bg-danger py-2"><i class="bi bi-door-closed"></i>　終　了</span>
                @else
                  @if( $enquete->start_at < now() )
                    <span class="badge bg-primary py-2"><i class="bi bi-door-closed"></i>　開催中</span>
                  @else
                    <span class="badge bg-warning py-2"><i class="bi bi-door-closed"></i>　開催前</span>
                  @endif
                @endif
                </div>
                <div class="col-md-7"><a href={{ route('enquete-show-board', $enquete->id) }}>{{ $enquete->title }}</a></div>
                <div class="col-md-2 h6 text-end">{{ $enquete->start_at }}</div>
                <div class="col-md-2 h6 text-end">{{ $enquete->expired_at }}</div>
              </div>
            @endforeach
        </div>
    </div>
  </div>
</section>

@endsection
