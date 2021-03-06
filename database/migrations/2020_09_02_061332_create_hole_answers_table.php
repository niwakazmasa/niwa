<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoleAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()


    {
        Schema::create('hole_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11)->unsigned()->comment('回答者のID');
            // 外部キーの設定
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('test_id')->length(11)->unsigned()->comment('テストのID');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目の問題か');
            $table->string('answer', 225)->comment('回答');
            $table->integer('Judgment')->length(11)->comment('1:正解 2:不正解');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hole_answers');
    }
}
