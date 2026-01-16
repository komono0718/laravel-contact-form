<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
<header class="header">
  <div class="header__inner">
  <a class="header__logo" href="/">FashionablyLate</a>
  </div>
</header>

<main>
  <div class="confirm__content">
    <div class="confirm__heading">
      <h2>confirm</h2>
    </div>

    {{-- 送信用フォーム --}}
    <form class="form" action="{{ route('thanks') }}" method="post">
      @csrf

<div class="confirm-table">
  <table class="confirm-table__inner">
    <tr>
      <th>お名前</th>
      <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
    </tr>

    <tr>
      <th>性別</th>
      <td>
        {{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}
      </td>
    </tr>

    <tr>
      <th>メールアドレス</th>
      <td>{{ $contact['email'] }}</td>
    </tr>

    <tr>
      <th>電話番号</th>
      <td>{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</td>
    </tr>

    <tr>
      <th>住所</th>
      <td>{{ $contact['address'] }}</td>
    </tr>

    <tr>
      <th>建物名</th>
      <td>{{ $contact['building'] }}</td>
    </tr>

    <tr>
      <th>お問い合わせの種類</th>
      <td>{{ $contact['category_content'] }}</td>
    </tr>

    <tr>
      <th>お問い合わせ内容</th>
      <td>{{ $contact['content'] }}</td>
    </tr>
  </table>
</div>

      <div class="form__button">
        <button type="submit" class="form__button-submit">送信</button>
      </div>
    </form>

    {{-- 修正ボタン --}}
    <form action="{{ route('back') }}" method="post">
      @csrf
      <div class="form__button">
        <button type="submit" class="form__button-submit form__button-submit--back">修正</button>
      </div>
    </form>

  </div>
</main>
</body>
</html>