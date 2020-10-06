<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Write_test extends Model
{
    protected $table = 'write_tests';

    public function serchTest(int $test_id, int $question_number)
    {
        return Write_test::where('test_id', $test_id)->where('question_number', $question_number)->get();
    }
}
