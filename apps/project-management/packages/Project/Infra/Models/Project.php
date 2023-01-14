<?php

namespace Project\Infra\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Project Eloquent Model
 *
 * @property int $id プロジェクトID
 * @property string $title プロジェクト名
 * @property string $description プロジェクト詳細
 * @property int $status プロジェクト状態
 * @property int $assign_to プロジェクト担当者
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'assign_to',
    ];
}
