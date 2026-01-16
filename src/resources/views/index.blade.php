<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
<header class="header">
  <div class="header__inner">
    <a class="header__logo" href="/">FashionablyLate</a>
  </div>
</header>

<main class="contact">
  <h2 class="contact__title">Contact</h2>

<form action="{{ route('confirm') }}" method="post">
  @csrf

    <div class="form-row">
      <div class="form-label">
        お名前 <span class="required">※</span>
      </div>
      <div class="form-control--name">
        <input class="input" type="text" name="last_name" placeholder="例：山田">
        <input class="input" type="text" name="first_name" placeholder="例：太郎">
      </div>
    </div>

    <div class="form-control">
    <div class="form-row">
      <div class="form-label">
        性別 <span class="required">※</span>
    </div>

    <div class="radio-group">
      <label class="radio-item">
      <input type="radio" name="gender" value="1"> 男性
      </label>
    <label class="radio-item">
      <input type="radio" name="gender" value="2"> 女性
    </label>
    <label class="radio-item">
      <input type="radio" name="gender" value="3"> その他
    </label>
  </div>
</div>

    <div class="form-row">
      <div class="form-label">
        メールアドレス <span class="required">※</span>
      </div>
      <div class="form-control">
        <input class="input input--full" type="email" name="email" placeholder="例：test@example.com">
      </div>
    </div>

    <div class="form-row">
      <div class="form-label">
        電話番号 <span class="required">※</span>
      </div>
      <div class="form-control--tel">
        <input class="input" type="text" name="tel1" placeholder="090">
        <span class="tel-sep">-</span>
        <input class="input" type="text" name="tel2" placeholder="1234">
        <span class="tel-sep">-</span>
        <input class="input" type="text" name="tel3" placeholder="5678">
      </div>
    </div>

    <div class="form-row">
      <div class="form-label">
        住所 <span class="required">※</span>
      </div>
      <div class="form-control">
        <input class="input input--full" type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
      </div>
    </div>

    <div class="form-row">
      <div class="form-label">
        建物名
      </div>
      <div class="form-control">
        <input class="input input--full" type="text" name="building" placeholder="例：千駄ヶ谷マンション101">
      </div>
    </div>

<div class="form-row">
  <div class="form-label">
    お問い合わせの種類 <span class="required">※</span>
  </div>
  <div class="form-control">
    <select class="select" name="category_id" required>
      <option value="" disabled selected>選択してください</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->content }}</option>
      @endforeach
    </select>
  </div>
</div>

    <div class="form-row form-row--textarea">
      <div class="form-label">
        お問い合わせ内容 <span class="required">※</span>
      </div>
      <div class="form-control">
        <textarea class="textarea" name="content" placeholder="お問い合わせ内容をご記載ください"></textarea>
      </div>
    </div>

    <div class="form-submit">
      <button class="submit-btn" type="submit">確認画面</button>
    </div>
  </form>
</main>
</body>
</html>