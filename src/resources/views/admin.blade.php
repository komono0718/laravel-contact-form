<!DOCTYPE html>
<html lang="ja">
<>
  <meta charset="UTF-8">
  <title>Admin</title>

  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #8b7969;
      color: #fff;
      font-weight: normal;
    }

    tr:hover {
      background-color: #f0e6dc;
    }

    button, .btn {
      padding: 6px 14px;
      border: none;
      border-radius: 4px;
      background-color: #8b7969;
      color: #fff;
      cursor: pointer;
      font-size: 14px;
      text-decoration: none;
      display: inline-block;
    }

    button:hover, .btn:hover {
      opacity: 0.8;
    }

    #modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
    }

    #modal > div {
      background: #fff;
      width: 500px;
      margin: 100px auto;
      padding: 24px;
      border-radius: 8px;
      position: relative;
    }

    #closeModal {
      background: none;
      color: #333;
      font-size: 18px;
      position: absolute;
      top: 10px;
      right: 10px;
    }
  </style>
</head>

<body>

<header class="header">
  <div class="header__inner">
    <a class="header__logo" href="/">FashionablyLate</a>
    <form method="post" action="/logout">
      @csrf
      <button class="header__logout">logout</button>
    </form>
  </div>
</header>

<div class="page-title">
  <h2>Admin</h2>
</div>

<form action="{{ route('admin.search') }}" method="get" class="search-form">
  {{-- 左：名前/メール（同じ箱） --}}
  <input
    class="search-input"
    type="text"
    name="name"
    placeholder="名前やメールアドレスを入力してください"
    value="{{ request('name') }}"
  >

  {{-- 性別 --}}
  <select class="search-select" name="gender">
    <option value="" {{ request('gender')==='' ? 'selected' : '' }}>性別</option>
    <option value="1" {{ request('gender')=='1' ? 'selected' : '' }}>男性</option>
    <option value="2" {{ request('gender')=='2' ? 'selected' : '' }}>女性</option>
    <option value="3" {{ request('gender')=='3' ? 'selected' : '' }}>その他</option>
  </select>

  {{-- 種類 --}}
  <select class="search-select" name="category_id">
    <option value="" {{ request('category_id')==='' ? 'selected' : '' }}>お問い合わせの種類</option>
    @foreach($categories as $category)
      <option value="{{ $category->id }}" {{ (string)request('category_id')===(string)$category->id ? 'selected' : '' }}>
        {{ $category->content }}
      </option>
    @endforeach
  </select>

  {{-- 日付 --}}
  <input class="search-date" type="date" name="date" value="{{ request('date') }}">

  {{-- ボタン --}}
  <button type="submit" class="btn-search">検索</button>
  <a href="{{ route('admin.reset') }}" class="btn-reset">リセット</a>
</form>

<div class="pagination-wrapper">
  {{ $contacts->links('pagination::bootstrap-4') }}
</div>

<div class="export-wrap">
  <a href="{{ route('admin.export', request()->query()) }}" class="btn-export">エクスポート</a>
</div>

<hr>

<div class="table-wrap">
<table>
  <thead>
    <tr>
      <th>お名前</th>
      <th>性別</th>
      <th>メールアドレス</th>
      <th>お問い合わせ内容</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach($contacts as $contact)
      <tr>
        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
        <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->content }}</td>
        <td>

<button
  type="button"
  class="btn-small detail-btn"
  data-id="{{ $contact->id }}"
>
  詳細
</button>

          <form action="{{ route('admin.delete') }}" method="post" style="display:inline;">
            @csrf
            <input type="hidden" name="id" value="{{ $contact->id }}">
        <button type="submit" class="btn-small btn-delete">削除</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>


<div id="modal">
  <div>
    <button id="closeModal">×</button>
    <h3>お問い合わせ詳細</h3>

    <p id="modal-name"></p>
    <p id="modal-gender"></p>
    <p id="modal-email"></p>
    <p id="modal-tel"></p>
    <p id="modal-address"></p>
    <p id="modal-building"></p>
    <p id="modal-category"></p>
    <p id="modal-content"></p>

    <!-- ▼ モーダル内 削除ボタン -->
    <form
      id="modal-delete-form"
      action="{{ route('admin.delete') }}"
      method="post"
      style="margin-top:20px; text-align:center;"
    >
      @csrf
      <input type="hidden" name="id" id="modal-delete-id">
      <button type="submit" class="btn-small btn-delete">削除</button>
    </form>
  </div>Ï
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  console.log('detail buttons:', document.querySelectorAll('.detail-btn').length);

  document.querySelectorAll('.detail-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      console.log('clicked', btn.dataset.id);

      fetch(`/admin/detail/${btn.dataset.id}`)
        .then(res => res.json())
        .then(data => {
          document.getElementById('modal-name').textContent = 'お名前：' + data.name;
          document.getElementById('modal-gender').textContent = '性別：' + data.gender;
          document.getElementById('modal-email').textContent = 'メール：' + data.email;
          document.getElementById('modal-tel').textContent = '電話番号：' + data.tel;
          document.getElementById('modal-address').textContent = '住所：' + data.address;
          document.getElementById('modal-building').textContent = '建物名：' + data.building;
          document.getElementById('modal-category').textContent = '種類：' + data.category;
          document.getElementById('modal-content').textContent = '内容：' + data.content;
          document.getElementById('modal-delete-id').value = btn.dataset.id;
          document.getElementById('modal').style.display = 'block';
        });
    });
  });

  document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('modal').style.display = 'none';
  });
});
</script>

</body>
</html>