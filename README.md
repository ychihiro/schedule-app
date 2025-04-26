# 基礎研修

> Laravel と Next.js を用いたゴルフ場予約管理アプリケーションのサンプルプロジェクト

---

## 目次

1. [概要](#概要)
2. [機能](#機能)
3. [前提条件](#前提条件)
4. [インストール](#インストール)
5. [環境変数](#環境変数)
6. [ディレクトリ構成](#ディレクトリ構成)
7. [開発コマンド](#開発コマンド)
8. [使用方法](#使用方法)
9. [ライセンス](#ライセンス)

---

## 概要

このリポジトリは、Laravel（バックエンド）と Next.js（フロントエンド）で構成された
ゴルフ場予約管理システムのサンプルプロジェクトです。  
API サーバーと SPA（Single‑Page Application）を統合し、予約の作成・一覧取得・リマインド機能を提供します。

## 機能

- ゴルフコース一覧取得
- ゴルフコース詳細取得
- 予約一覧取得
- 予約詳細取得
- 予約作成
- 予約リマインド (CLI コマンド)

## 前提条件

- Docker & Docker Compose
- Make
- Node.js (推奨 v14 以上)
- npm (推奨 v6 以上)
- PHP (v8.1 以上)
- Composer

## インストール

```bash
# リポジトリをクローン
git clone <リポジトリURL>
cd <リポジトリ名>

# 必要パッケージのインストールと環境起動
make install
```

## 環境変数

### バックエンド (backend/.env)

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:mHS5IX6AZ76F5TPCfdBiUf4v2vEnHUskmHlj4oGY3WQ=
APP_DEBUG=true
APP_URL=http://localhost:50080

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=dbuser
DB_PASSWORD=db12345

RAKUTEN_GORA_APPLICATION_ID=【楽天GORAのアプリID】
```

### フロントエンド (frontend/.env.local)

```env
API_BASE_URL=http://backend:50080
NEXT_PUBLIC_API_BASE_URL=http://localhost:50080
NEXT_PUBLIC_FRONTEND_URL=http://localhost:3000
```

## ディレクトリ構成

## 環境構築

1. make install

### Rakuten Gora API

[こちら](https://webservice.rakuten.co.jp/guide)からアプリ ID を取得  
`backend/.env`の`RAKUTEN_GORA_APPLICATION_ID=`にアプリ ID を設定

例
`RAKUTEN_GORA_APPLICATION_ID=1122280314645528641`

## 機能一覧

### GolfCourse

- ゴルフコース一覧取得
- ゴルフコース詳細取得

### Reserve

- 予約一覧取得
- 予約詳細取得
- 予約作成
- 予約リマインド

### 予約リンマインド実行方法

1. make app
2. php artisan reserve:remind

※`reserves.start_date === 実行日の翌日` 且つ `reserves.status_id === 2` である必要があります

## 開発コマンド

- `make up` : 開発環境の起動
- `make down` : 開発環境の停止
- `make test` : バックエンドのテスト実行 (`php artisan test`)
- `make migrate` : マイグレーション実行
- `make fresh` : マイグレーションリセット+シード
- `make lint` : フロントエンドの ESLint チェック
- `make format` : フロントエンドのコードフォーマット

## 使用方法

1. `make up` で環境を起動
2. ブラウザで `http://localhost:3000` にアクセス
3. API ドキュメント
   - `/api` エンドポイントを Postman 等で叩いて確認

### 予約リマインドの実行

```bash
# Docker コンテナ内で artisan コマンドを実行
make app
php artisan reserve:remind
```

## ライセンス

MIT License
