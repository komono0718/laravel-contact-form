<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'FashionablyLate')</title>

  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  @yield('css')
</head>

<body>

<header class="header">
  <div class="header__inner">
    <a class="header__logo" href="/">FashionablyLate</a>

    @hasSection('header-button')
      @yield('header-button')
    @endif
  </div>
</header>

<main>
  @yield('content')
</main>

</body>
</html>