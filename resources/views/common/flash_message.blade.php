{{-- フラッシュメッセージ始まり --}}
{{-- 成功の時 --}}
@if (session('successMessage'))
  <div class="alert alert-success text-center">
    {{ session('successMessage') }}
  </div>
@endif
{{-- 失敗の時 --}}
@if (session('errorMessage'))
  <div class="alert alert-danger text-center">
    {{ session('errorMessage') }}
  </div>
@endif
{{-- フラッシュメッセージ終わり --}}
