<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->length(11)->unsigned()->comment('アンケートのID');
            $table->string('question', 255)->comment('アンケートの内容');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目のアンケートか');
            $table->integer('role')->length(11)->default(2)->comment('問題の種類');
            $table->integer('select1')->length(11)->comment('選択肢');
            $table->integer('select2')->length(11)->comment('選択肢');
            $table->string('select_item1', 255)->length(11)->comment('選択肢の内容');
            $table->string('select_item2', 255)->length(11)->comment('選択肢の内容');
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
        Schema::dropIfExists('select_surveys');
    }
}
