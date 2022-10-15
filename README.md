Laravel9 Base プロジェクト
====================


<!-- @import "[TOC]" {cmd="toc" depthFrom=1 depthTo=6 orderedList=false} -->

<!-- code_chunk_output -->

- [前提条件](#前提条件)
- [環境](#環境)
  - [バージョン](#バージョン)
  - [コンテナ](#コンテナ)
  - [機能](#機能)
- [構築](#構築)
  - [管理者向け](#管理者向け)
  - [開発者向け](#開発者向け)

<!-- /code_chunk_output -->

## 前提条件

* docker, docker-composeがインストールされていること
* bashが利用できること
* makeが利用できること

## 環境

### バージョン

| プログラム | バージョン |
| ---------- | ---------- |
| php        | 8.1.2      |
| laravel    | 9.0.1      |
| mysql      | 8.0.28     |

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

## 構築

### 管理者向け

プロジェクトの初期構築手順は以下を参照
* [初期構築](./docs/init-project.md)

### 開発者向け

リポジトリをclone後, run.shシェルにて環境構築してください

```bash
# リポジトリ clone
git clone [リポジトリURL]

# 初期構築
./run.sh init
```
