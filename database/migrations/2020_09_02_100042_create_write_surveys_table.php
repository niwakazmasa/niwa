<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriteSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('write_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->length(11)->unsigned()->comment('アンケートのID');
            $table->string('question', 255)->comment('アンケートの内容');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目のアンケートか');
            $table->integer('role')->length(11)->default(1)->comment('問題の種類');
            $table->timestamps();

            // 外部キーの設定
            $table->foreign('survey_id')->references('id')->on('surveys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('write_surveys');
    }
}
