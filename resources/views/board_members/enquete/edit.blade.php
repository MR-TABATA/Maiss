@extends('common.base')
@section('title', EnqueteConsts::TITLE_EDIT)
@section('content')

<div class="pagetitle">
  <h1>{{EnqueteConsts::TITLE_EDIT}}</h1>
</div>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<section class="section">
  <form action="" method="post">
  @csrf

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">タイトル</label>
    <div class="col-md-7">
      <input type="text" name="title" class="form-control" value="{{$enquete->title}}"/>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">開始日時</label>
    <div class="col-md-7">
      <input type="text" name="start_at" class="form-control" value="{{ $enquete->start_at }}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputText" class="col-md-3 col-form-label">期限日時</label>
    <div class="col-md-7">
      <input type="text" name="expired_at" class="form-control" value="{{ $enquete->expired_at }}"/>
      <h6 class="text-danger mt-md-2">{{CommonConsts::DATE_FORMAT}}</h6>
    </div>
  </div>

  <div class="row mb-3">
    <label for="inputPassword" class="col-md-3 col-form-label">内容</label>
    <div class="col-md-7">
      <textarea name="detail" class="form-control" style="height: 300px">{{ $enquete->detail }}</textarea>
    </div>
  </div>

  @foreach($enquete->items AS $enquete_item_key => $item)
    <div class="row mb-3">
      <label for="inputPassword" class="col-md-3 col-form-label">選択肢 {{$enquete_item_key+1}}</label>
      <div class="col-md-7">
        <input type="text" name="option[{{$enquete_item_key}}]" class="form-control" value="{{ $item->option }}" />
      </div>
    </div>
  @endforeach

  @for ($counter = $enquete_item_key+1; $counter < EnqueteConsts::OPTION_COUNTER; $counter++)
    <div class="row mb-3">
      <label for="inputPassword" class="col-md-3 col-form-label">選択肢 {{$counter+1}}</label>
      <div class="col-md-7">
        <input type="text" name="option[{{$counter}}]" class="form-control" value="{{ old('option_'.$counter) }}" />
      </div>
    </div>
  @endfor

  <div class="row mb-3">
  <div class="col-md-3"></div>
  <div class="col-md-6">
      <button type="submit" class="btn btn-primary px-5 w-25">変更</button>
    </div>
  </div>
</form>
</section>
@endsection
