<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoleTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hole_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned()->comment('テストのID');
            $table->string('question', 255)->comment('問題');
            $table->string('answer1', 255)->comment('問題の答え');
            $table->string('answer2', 255)->comment('問題の答え');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目の問題か');
            $table->integer('role')->length(11)->default(3)->comment('問題の種類');
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
        Schema::dropIfExists('hole_tests');
    }
}
