@extends('common.base')
@section('title', EnqueteConsts::TITLE_SHOW)
@section('content')

<div class="pagetitle">
  <h1>{{EnqueteConsts::TITLE_SHOW}}</h1>
</div>

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

          {!! nl2br(e($enquete->detail)) !!}
          <p>開始：{{$enquete->start_at}}</p>
          <p>〆切：{{$enquete->expired_at}}</p>
        </div>
      </div>
    </div>
  </div>

    @if (count($answer) == 0)
      @if ($errors->any())
        <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    <form action="{{ route('enquete-answer-store') }}" method="POST">
    @csrf
    <input type="hidden" name="enquete_id" value="{{ $enquete->id}}">
    <fieldset class="row mb-3">
      <legend class="col-form-label col-sm-2 pt-0">選択項目</legend>
      <div class="col-sm-10">
        @foreach($enquete->items AS $item)
        <div class="form-check">
          <input class="form-check-input" type="radio" name="enquete_item_id" id="gridRadios1" value="{{$item->id}}">
          <label class="form-check-label" for="gridRadios1">
            {{$item->option}}
          </label>
        </div>
        @endforeach
        <div class="form-floating mt-3">
          <textarea class="form-control" name="comment" placeholder="ご意見・条件等" id="floatingTextarea" style="height: 150px;"></textarea>
          <label for="floatingTextarea">ご意見・条件等</label>
        </div>
        @if($enquete->start_at <= \Carbon\Carbon::now())
          @if($enquete->expired_at > \Carbon\Carbon::now())
            <button type="submit" class="btn btn-primary mt-3 px-5">アンケートに答える</button>
          @else
            <p class="mt-3">アンケート募集は終了しました</p>
          @endif
        @else
          <p class="mt-2">{{$enquete->start_at}}まで、お待ちください</p>
        @endif
      </div>
    </fieldset>
    @else
    <div class="alert alert-danger mt-3">
      <ul>
        <li>回答、登録済みです</li>
      </ul>
    </div>
    </form>
    @endif

</section>






@endsection
