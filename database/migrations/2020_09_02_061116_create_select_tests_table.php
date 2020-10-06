<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned()->comment('テストのID');
            $table->string('question', 255)->comment('問題');
            $table->integer('answer')->length(11)->comment('問題の答え');
            $table->integer('select1')->length(11)->default(1)->comment('選択肢');
            $table->integer('select2')->length(11)->default(2)->comment('選択肢');
            $table->integer('select3')->length(11)->default(3)->comment('選択肢');
            $table->integer('select4')->length(11)->default(4)->comment('選択肢');
            $table->integer('select5')->length(11)->default(5)->nullable()->comment('選択肢');
            $table->integer('select6')->length(11)->default(6)->nullable()->comment('選択肢');
            $table->integer('select7')->length(11)->default(7)->nullable()->comment('選択肢');
            $table->integer('select8')->length(11)->default(8)->nullable()->comment('選択肢');
            $table->string('select_item1', 255)->comment('選択肢の内容');
            $table->string('select_item2', 255)->comment('選択肢の内容');
            $table->string('select_item3', 255)->comment('選択肢の内容');
            $table->string('select_item4', 255)->comment('選択肢の内容');
            $table->string('select_item5', 255)->nullable()->comment('選択肢の内容');
            $table->string('select_item6', 255)->nullable()->comment('選択肢の内容');
            $table->string('select_item7', 255)->nullable()->comment('選択肢の内容');
            $table->string('select_item8', 255)->nullable()->comment('選択肢の内容');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目の問題か');
            $table->integer('role')->length(11)->default(2)->comment('問題の種類');
            $table->timestamps();

            // 外部キーの設定
            $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('select_tests');
    }
}
