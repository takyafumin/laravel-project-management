projects
====================

プロジェクト


## 概要

案件情報を管理する


## 項目

|    項目     |               型               | NULL | DEFAULT |     コメント     |
| :---------- | :----------------------------- | :--- | :------ | :--------------- |
| id          | bigint unsigned auto_increment | -    | -       | プロジェクトID   |
| title       | varchar(50)                    | -    | -       | プロジェクト名   |
| description | varchar(255)                   | NULL | NULL    | プロジェクト詳細 |
| status      | tinyint unsigned               | -    | -       | 状態             |
| assign_to   | bigint unsigned                | NULL | NULL    | 担当者           |
| created_at  | datetime                       | -    | -       | 登録日時         |
| updated_at  | datetime                       | NULL | NULL    | 更新日時         |
| deleted_at  | datetime                       | NULL | NULL    | 削除日時         |


## インデックス

|  種類   |    項目    |
| :------ | :--------- |
| PRIMARY | id         |
| INDEX   | title      |
| INDEX   | status     |
| INDEX   | assign_to  |
| INDEX   | deleted_at |


## 外部キー

|   項目    |   対象   |
| :-------- | :------- |
| assign_to | user(id) |
