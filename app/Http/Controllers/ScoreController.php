<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

    public function index(Request $request){



             //デフォルト表示の時に使う
             $query = test::query();
             $db = $query->get();
             $it = DB::table('test_results')->get();
             $dfavg = $it->avg('score');


             // ポストした内容を表示
             $testss = $request->input('test');
             $status = $request->input('status');
             $sortstart = $request->input('sort-start');
             $sortend = $request->input('sort-end');


             $test = test::value('created_at');
             $created_at = date('Y-m-d',strtotime($test));

             $testid = test::whereTitle("$testss")->value('id');
             $items = DB::table('test_results')->whereTest_id("$testid")->get();
             $avg = $items->avg('score');

             if (!empty($sortstart && $sortend)) {
               $query->whereBetween('created_at', ["$sortstart", "$sortend"]);
             }

             if (!empty($testss)) {
               $query->where('title', "$testss");
             }

             if (!empty($status)) {
               $query->where('status', "$status");
             }


             $dblist = $query->get();
             // dump($dblist);


        //ブレードへ
       return view('score',compact('dblist', 'testss', 'status', 'dfavg', 'avg', 'db', 'items'));

    }


}
