@extends('common.base')
@section('title', $enquete->title)
@section('content')

<div class="pagetitle">
  <h1>アンケート</h1>
</div>

<section class="section">
  <div class="row align-items-top">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{$enquete->title}}</h5>
          {!! nl2br(e($enquete->detail)) !!}
          <p>〆切：{{$enquete->expired_at}}</p>
        </div>
      </div>
    </div>
  </div>
  アンケートへの回答、ありがとうございました
</section>






@endsection
