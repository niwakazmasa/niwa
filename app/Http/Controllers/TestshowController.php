<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestshowController extends Controller
{

    public function show($id, Request $request)
    {

      $test = Test::find($id);
      $selectitems = DB::table('select_tests')->whereTest_id("$id")->get()->toArray();
      $writeitems = DB::table('write_tests')->whereTest_id("$id")->get()->toArray();
      $holeitems = DB::table('hole_tests')->whereTest_id("$id")->get()->toArray();

      $sum = array_merge($selectitems, $writeitems, $holeitems);

      $count_questions = count($sum);

      $sorts = collect($sum);
      dump($sorts);
      // $product = collect($sum)->value('answer')->get();
      // $product = collect($sum)->firstWhere('answer', 4);

      $sort = $sorts->sortBy('question_number')->all();
      // $product = collect($sort)->firstWhere('answer', 4);
      // $product = collect($sort)->pluck('answer','answer1','answer2')->all();
      dump($sort);


      return view('testshow',
        [
          'count_questions' => $count_questions,
          'test' => $test,
          'test_id' => $id,
        ], compact('sort'));


       return view('testshow');
    }
}
