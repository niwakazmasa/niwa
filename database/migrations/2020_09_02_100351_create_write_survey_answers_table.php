<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriteSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('write_survey_answers', function (Blueprint $table) {
            $table->increments('id');
           $table->integer('user_id')->length(11)->unsigned()->comment('回答者のID');
            $table->integer('survey_id')->length(11)->unsigned()->comment('アンケートのID');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目のアンケートか');
            $table->string('answer', 225)->comment('回答');
            $table->timestamps();

            // 外部キーの設定
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('write_survey_answers');
    }
}
