# お問い合わせフォーム

本アプリケーションは、お問い合わせフォームの送信および  
管理画面からのお問い合わせ管理を行うWebアプリケーションです。

ユーザーはお問い合わせを送信でき、  
管理者は会員登録・ログイン後にお問い合わせ内容の確認・検索・削除・CSVエクスポートを行うことができます。


## 環境構築手順

以下の手順で、**マイグレーション実行まで** 環境構築が可能です。

### 1. リポジトリをクローン

```bash
git clone <git@github.com:komono0718/laravel-contact-form.git>
```

### 2. プロジェクトへ移動

```bash
cd laravel-contact-form
```

### 3. Docker コンテナの作成&起動

```bash
docker compose up -d --build
```

### 4. PHPコンテナにログイン

```bash
docker compose exec php bash
```

### 5. Composer インストール

```bash
composer install
```

### 6. .env ファイルの作成

```bash
cp .env.example .env
```

.env を開き、以下のデータベース設定を環境に合わせて変更してください。

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 7. アプリケーションキー生成

```bash
php artisan key:generate
```


### 8. マイグレーション実行

```bash
php artisan migrate
```

### 9. シーディング（ダミーデータ作成）

```bash
php artisan db:seed
```

作成されるダミーデータ
	•	categories テーブル：5件
	•	商品のお届けについて
	•	商品の交換について
	•	商品トラブル
	•	ショップへのお問い合わせ
	•	その他
	•	contacts テーブル：35件（factory 使用）


## 備考
	•	認証機能には Laravel Fortify を使用しています。
	•	バリデーションは FormRequest を使用しています。
	•	設計・実装は COACHTEC の案件シートに準拠しています。


## 使用技術

- PHP 8.x
- Laravel 9.x
- MySQL
- Docker / Docker Compose
- Laravel Fortify（認証機能）

## 開発環境

	•	お問い合わせ画面：　http://localhost/
	•	ユーザー登録画面：　http://localhost/register
	•	phpMyAdmin：　　　http://localhost:8080/

## ER図

![ER図](./docs/er_diagram.png)

## ダミーデータについて

以下のコマンドを実行することで、ダミーデータを作成できます。

```bash
php artisan db:seed
```

	•	categories テーブル：5件（CategoriesSeeder 使用）
	•	contacts テーブル：35件（factory 使用）
