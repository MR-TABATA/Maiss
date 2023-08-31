@extends('common.base')
@section('title', BoardConsts::TITLE_INDEX)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{BoardConsts::TITLE_INDEX}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

<section class="section">

<div class="row">
  <div class="col-lg-12">
    <div class="card info-card sales-card">
      <div class="card-body">
        @foreach($boards AS $key =>$board)
          <div class="row mt-2">
            <div class="col-md-3">
              @if( $key == 0)
                {{$boards[$key]->start_date}} 〜 {{$boards[$key]->end_date}}
              @elseif($key > 0 && $boards[$key]->start_date != $boards[$key - 1]->start_date)
                {{$boards[$key]->start_date}} 〜 {{$boards[$key]->end_date}}
              @endif

            </div>
            <div class="col-md-1">
              {{$board->team}}組
            </div>
            <div class="col-md-2">
              @if( $board->user )
              {{$board->user->family_name}}　{{$board->user->given_name}}
              @endif
            </div>
            <div class="col-md-1">
              @if( $board->user )
              {{$board->user->room}}号
              @endif
            </div>
            <div class="col-md-1 text-end">
              <a href="{{ route('board-show-edit-board', $board->id) }}"><i class="bi bi-pencil-square"></i> 更新</a>
            </div>
            <div class="col-md-1 text-end">
              <a href="{{ route('board-delete-board', $board->id) }}" onclick="return confirm('{{$board->user->family_name}}さんを役員から削除します。よろしいですか？')"><i class="bi bi-trash"></i> 削除</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

</section>

@endsection
