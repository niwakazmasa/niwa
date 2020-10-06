<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class selectSurveysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('select_surveys')->insert([
            'survey_id' => 1,
            'question' => 'お金欲しい？',
            'select1' => 1,
            'select2' => 2,
            'select_item1' => 'ほしい',
            'select_item2' => 'いらない',
            'question_number' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
