@extends('common.base')
@section('title', EnqueteConsts::TITLE_INDEX)
@section('content')

<div class="pagetitle">
  <h1>{{EnqueteConsts::TITLE_INDEX}}</h1>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="card info-card sales-card">
        <div class="card-body">
            @foreach($enquetes AS $enquete)
              <div class="row mt-2">
                <div class="col-md-8">
                  <a href={{ route('enquete-show', $enquete->id) }}>{{ $enquete->title }}</a>
                  @if( $enquete-> expired_at < now() )<span class="text-danger">（終了）</span>@endif
                </div>
                <div class="col-md-4 h6 text-end">{{ $enquete->start_at }}　〜　{{ $enquete->expired_at }}</div>
              </div>
            @endforeach
        </div>
    </div>
  </div>
</section>

@endsection
