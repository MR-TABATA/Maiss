@extends('common.base')
@section('title', UserConsts::TITLE_INDEX)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{UserConsts::TITLE_INDEX}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

<section class="section">

<div class="row">
  <div class="col-lg-12">
    <div class="card info-card sales-card">
      <div class="card-body">
        @foreach($users AS $user)
          <div class="row mt-2 p-2 border-bottom">
            <div class="col-md-2">@if($user->role <= 11) 組合員 @endif</div>
            <div class="col-md-2">@if($user->role != 1) {{UserConsts::ROLE_LIST[$user->role]}} @endif</div>
            <div class="col-md-2">@if($user->room > 0) {{$user->room}}号 @endif</div>
            <div class="col-md-3">{{$user->family_name}}　{{$user->given_name}}</div>
            @can('chairman')
            <div class="col-md-3">
              <a href="{{ route('user-edit-board', $user->id) }}" class="p-lg-3 m-lg-1"><i class="bi bi-pencil-square"></i></a>
              <a href="{{ route('user-delete-board', $user->id) }}" class="p-lg-3 m-lg-1" onclick="return confirm('{{$user->family_name}}　{{$user->given_name}}を削除します。よろしいですか？')"><i class="bi bi-trash"></i></a>
            </div>
            @endcan
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

</section>

@endsection
