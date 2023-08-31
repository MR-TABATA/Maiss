@extends('common.base')
@section('title', RuleConsts::TITLE_IMPORT_EXPORT)
@section('content')

<div class="pagetitle mb-3">
  <h1>{{ RuleConsts::TITLE_IMPORT_EXPORT }}</h1>
</div><!-- End Page Title -->

@include('common.flash_message')

<section class="section">

<div class="row mt-5 mb-5">
  <div class="col-lg-3">
    <a href="{{ route('rule-export-board') }}" type="button" class="btn btn-primary w-75">CSVエクスポート</a>
  </div>
</div>
<hr />
<form method="POST" action="{{ route('rule-import-board') }}" enctype="multipart/form-data">
  @csrf
  <div class="row mt-5 mb-5">
    <div class="col-lg-4">
      <input type="file" id="file" name="file" class="form-control" />
    </div>
    <div class="col-lg-3">
      <button type="submit" class="btn btn-outline-primary w-75">CSVインポート</button>
    </div>
  </div>
</form>
</section>

@endsection
