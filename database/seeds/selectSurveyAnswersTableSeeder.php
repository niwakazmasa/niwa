<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class selectSurveyAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('select_survey_answers')->insert([
            'user_id' => 1,
            'survey_id' => 1,
            'question_number' => 1,
            'answer' => 1,
            'answer_item' => 'ほしい',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
