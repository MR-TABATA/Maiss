@extends('common.base')
@section('title', 'アンケートトップ')
@section('content')

<div class="pagetitle">
  <h1>アンケート一覧</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">アンケート</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h3 class="fw-normal mb-3 card-title">回答募集中</h3>
            @foreach($on_enquetes AS $on_enquetes)
              <div class="row mt-2">
                <div class="col-md-8 h5"><a href={{ route('enquete-show', $on_enquetes->id) }}>{{ $on_enquetes->title }}</a></div>
                <div class="col-md-4 h6 text-end">{{ $on_enquetes->expired_at }}</div>
              </div>
            @endforeach
        </div>
    </div>
  </div>
</section>

@endsection
