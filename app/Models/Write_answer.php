<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Write_answer extends Model
{
    protected $table = 'write_answers';

    // 未採点の記述回答を取得
    public function getUnscored()
    {
        return Write_answer::where('Judgment', 3)->get();
    }

    public function getWriteAnswer(int $id)
    {
        return Write_answer::find($id);
    }

    public function getUsersWriteAnswer(int $user_id, int $test_id)
    {
        return Write_answer::where('user_id', $user_id)->where('test_id', $test_id)->where('Judgment', 3)->get();
    }

    public function getEditWriteAnswer(int $user_id, int $test_id, int $question_number)
    {
        return Write_answer::where('user_id', $user_id)->where('test_id', $test_id)->where('question_number', $question_number)->get();
    }

    public function editWrite_answer(Write_answer $write_answer, int $judgment)
    {
        $write_answer->Judgment = $judgment;
        $write_answer->updated_at = Carbon::now();
        $write_answer->save();
    }
}
