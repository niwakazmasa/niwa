<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWriteTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('write_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id')->unsigned()->comment('テストのID');
            $table->string('question', 255)->comment('問題');
            $table->integer('question_number')->length(11)->unsigned()->comment('何問目の問題か');
            $table->integer('role')->length(11)->default(1)->comment('問題の種類');
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
        Schema::dropIfExists('write_tests');
    }
}
