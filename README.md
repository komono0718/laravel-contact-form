# laravel-docker-template

## 事前準備
以下がインストール・起動されていることを前提とします。

- Git
- Docker Desktop（起動していること）

## 環境構築

### 1. リポジトリをクローン
任意のディレクトリで以下を実行してください。
```
git clone git@github.com:komono0718/laravel-contact-form.git
cd laravel-contact-form
```

### 2. Dockerコンテナをビルド・起動
```
docker-compose up -d --build
```

### 3. PHPコンテナに入る
```
docker-compose exec php bash
```

### 4. Composerパッケージのインストール
```
composer install
```

### 5. 環境変数ファイルの作成
```
cp .env.example .env
```

### 6. 環境変数の設定
.env ファイルを以下のように修正してください。
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 7. アプリケーションキー生成
```
php artisan key:generate
```

### 8. マイグレーションの実行
```
php artisan migrate
```
