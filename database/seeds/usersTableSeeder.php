<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'slack_name' => 'テスト',
            'slack_id' => "abc",
            'slack_mail' => 'test@test.com',
            'slack_image' => 'abc',
            'password' => Hash::make('kjikboRERTFKU98hg'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
