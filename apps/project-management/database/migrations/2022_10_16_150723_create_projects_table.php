<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** @var string テーブル名 */
    private const TABLE_NAME = 'projects';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            // comment
            $table->comment('プロジェクト');

            // column
            $table->id()->comment('プロジェクトID');
            $table->string('title', 50)->comment('プロジェクト名');
            $table->string('description', 255)->nullable()->comment('プロジェクト詳細');
            $table->tinyInteger('status')->comment('状態');
            $table->unsignedBigInteger('assign_to')->nullable()->comment('担当者');
            $table->dateTime('created_at')->comment('登録日時');
            $table->dateTime('updated_at')->nullable()->comment('更新日時');
            $table->dateTime('deleted_at')->nullable()->comment('削除日時');

            // index
            $table->index('title');
            $table->index('status');
            $table->index('assign_to');
            $table->index('deleted_at');

            // foreign key
            $table->foreign('assign_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
