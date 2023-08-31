@extends('common.base')
@section('title', $title)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{$title}}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

<section class="section">

<div class="row">
  <div class="col-lg-12">
    <div class="card info-card sales-card">
      <div class="card-body">
        @foreach($rules AS $key =>$rule)
          <div class="row mt-2">
            @if($rules[$key]->chapter_str)
            <div class="col-md-2">
              @if( $key == 0)
                第{{$rules[$key]->chapter}}章 　{{$rules[$key]->chapter_str}}
              @elseif($key > 0 && $rules[$key]->chapter != $rules[$key - 1]->chapter)
                第{{$rules[$key]->chapter}}章 　{{$rules[$key]->chapter_str}}
              @endif
            </div>
            @endif
            @if($rules[$key]->section_str)
            <div class="col-md-2">
              @if( $key == 0)
                第{{$rules[$key]->section}}節 　{{$rules[$key]->section_str}}
              @elseif($key > 0 && $rules[$key]->section != $rules[$key - 1]->section)
                第{{$rules[$key]->section}}節 　{{$rules[$key]->section_str}}
              @endif
            </div>
            @endif
            <div class="col-md">
              第{{ $rule->paragraph }}条　（<a href="{{ route('rule-show-edit-board', ['id'=>$rule->id, 'type'=>$rule->type]) }}"><i class="bi bi-pencil-square"></i> 更新</a>）
              <p class="lh-lg" style="text-align: justify;">{!! nl2br($rule->paragraph_text) !!}　
              </p>
            </div>

          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

</section>

@endsection
