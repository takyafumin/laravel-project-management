Laravel, 案件管理システム
====================


<!-- @import "[TOC]" {cmd="toc" depthFrom=1 depthTo=6 orderedList=false} -->

<!-- code_chunk_output -->

- [前提条件](#前提条件)
- [環境](#環境)
  - [バージョン](#バージョン)
  - [コンテナ](#コンテナ)
  - [機能](#機能)
- [使い方](#使い方)
- [その他](#その他)
  - [初期設定](#初期設定)

<!-- /code_chunk_output -->

## 前提条件

* docker, docker-composeがインストールされていること
* bashが利用できること

## 環境

### バージョン

| プログラム | バージョン |
| ---------- | ---------- |
| php        | 8.1.10     |
| mysql      | 8.0        |

### コンテナ

| コンテナ |            機能            |
| -------- | -------------------------- |
| php      | Appサーバ                  |
| mysql    | DBサーバ                   |
| redis    | Session/Cacheサーバ        |
| adminer  | DB WebGUI                  |
| mailhog  | メールサーバ/メール WebGUI |

### 機能

|   機能    |          URL           |
| --------- | ---------------------- |
| アプリ    | http://localhost/      |
| DB GUI    | http://localhost:8080/ |
| Mail GUI  | http://localhost:8025/ |

## 使い方

リポジトリをclone後, run.shシェルにて環境構築してください

```bash
# リポジトリ clone
git clone [リポジトリURL]

# 初期構築
./run.sh init
```

## その他

### 初期設定

* 認証パッケージ追加
* locale変更
* 日本語化
```bash
php -r "copy('https://readouble.com/laravel/8.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"
```