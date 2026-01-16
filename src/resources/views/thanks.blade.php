<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Thanks</title>

  <!-- ゴシック用（※ thanks-text だけで使用） -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500;600&display=swap" rel="stylesheet">

  <style>
    /* ===== base（明朝体） ===== */
    body{
      margin:0;
      background:#fff;
      color:#8b7969;
      font-family: "Times New Roman", "游明朝", "Yu Mincho", serif;
    }

    /* ===== header ===== */
    header{
      border-bottom:1px solid #eee;
      padding:24px 0;
      text-align:center;
    }

    header a{
      text-decoration:none;
      color:#8b7969;
      font-size:32px;
      font-weight:normal;
    }

    /* ===== main ===== */
    main{
      position:relative;
      height:calc(100vh - 90px);
      display:flex;
      justify-content:center;
      align-items:center;
    }

    /* 背景 Thank you（明朝体のまま） */
    .bg{
      position:absolute;
      font-size:150px;
      font-weight:bold;
      letter-spacing:0.12em;
      color:rgba(139,121,105,0.08);
      white-space:nowrap;
      font-family: "Times New Roman", "游明朝", "Yu Mincho", serif;
    }

    .message{
      position:relative;
      text-align:center;
    }

    /* ★ ここだけゴシック ★ */
    .thanks-text{
      font-family: "Noto Sans JP", sans-serif;
      font-size:20px;
      font-weight:600;
      letter-spacing:0.04em;
      margin-bottom:30px;
    }

    /* HOME ボタン（明朝体のまま） */
    .btn{
      display:inline-block;
      padding:12px 40px;
      background:#8b7969;
      color:#fff;
      text-decoration:none;
      font-size:14px;
      font-weight:normal;
      font-family: "Times New Roman", "游明朝", "Yu Mincho", serif;
    }
  </style>
</head>

<body>
  <header>
    <a href="/">FashionablyLate</a>
  </header>

  <main>
    <div class="bg">Thank you</div>

    <div class="message">
      <p class="thanks-text">お問い合わせありがとうございました</p>
      <a href="/" class="btn">HOME</a>
    </div>
  </main>
</body>
</html>