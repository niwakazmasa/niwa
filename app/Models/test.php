<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Test extends Model
{
    protected $table = 'tests';

    public function getTestUnscored(int $test_id)
    {
        return Test::find($test_id);
    }

    public function createTest($request)
    {
      $test = new Test();
      $test->title = $request->title;
      $test->status = $request->status;
      $test->test_time = $request->test_time;
      $test->created_at = Carbon::now();
      $test->updated_at = Carbon::now();
      $test->save();
    }

}
