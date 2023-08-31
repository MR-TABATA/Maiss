
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>サインインページ</title>

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- CSSの設定ファイル -->
  <link rel="stylesheet" href="/css/sign-in.css">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <main class="form-signin w-100 m-auto">
    <form action="" method="post" class="text-center">
    @csrf
      <img class="mb-4" src="/common/images/logo.png" alt="" width="128" height="128" loading="lazy">
      <h1 class="h3 mb-3 fw-normal">サインインして下さい</h1>

      <div class="form-floating">
        <input type="text" name="account" class="form-control" id="floatingInput" placeholder="アカウント">
        <label for="floatingInput">アカウント</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="パスワード">
        <label for="floatingPassword">パスワード</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          状態を記憶する
        </label>
      </div>
      <button class="btn btn-purple w-100 py-2" type="submit">サインイン</button>
      <p class="mt-5 mb-3 text-body-secondary">&copy; 2017-2023</p>
   </form>
  </main>

</body>

</html>
