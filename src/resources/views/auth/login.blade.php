<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<header class="header">
  <div class="header__inner">
    <a class="header__logo" href="/">FashionablyLate</a>
    <a class="header__link" href="{{ route('register') }}">register</a>
  </div>
</header>

<div class="page-title">
  <h2>Login</h2>
</div>

<div class="auth-card">
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label>メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}">
      @error('email')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label>パスワード</label>
      <input type="password" name="password">
      @error('password')<div class="error">{{ $message }}</div>@enderror
    </div>

    <button class="btn-submit">ログイン</button>
  </form>
</div>

</body>
</html>