users
====================

ユーザ


## 概要

ユーザ情報を管理する


## 項目

|       項目        |               型               | NULL | DEFAULT |          コメント          |
| :---------------- | :----------------------------- | :--- | :------ | :------------------------- |
| id                | bigint unsigned auto_increment | -    | -       | ユーザID                   |
| name              | varchar(255)                   | -    | -       | ユーザ名                   |
| email             | varchar(255)                   | -    | -       | メールアドレス             |
| email_verified_at | datetime                       | NULL | NULL    | メールアドレス確認日時     |
| password          | varchar(255)                   | -    | -       | パスワード                 |
| remember_token    | varchar(100)                   | NULL | NULL    | パスワードリセットトークン |
| created_at        | datetime                       | -    | -       | 登録日時                   |
| updated_at        | datetime                       | NULL | NULL    | 更新日時                   |
| deleted_at        | datetime                       | NULL | NULL    | 削除日時                   |


## インデックス

|  種類   | 項目  |
| :------ | :---- |
| PRIMARY | id    |
| INDEX   | email |


## 外部キー
