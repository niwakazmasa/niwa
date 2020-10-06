<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class selectTestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('select_tests')->insert([
            'test_id' => 1,
            'question' => '1 + 2は何？',
            'answer' => 4,
            'select1' => 1,
            'select2' => 2,
            'select3' => 3,
            'select4' => 4,
            'select_item1' => 'あ',
            'select_item2' => 'い',
            'select_item3' => 'う',
            'select_item4' => '3',
            'question_number' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
