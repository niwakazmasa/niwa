<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Write_test;
use App\Models\Select_test;
use App\Models\Hole_test;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TesteditController extends Controller
{
    public function edit($id, Request $request)
    {

      $test = Test::find($id);
      $selectitems = DB::table('select_tests')->whereTest_id("$id")->get()->toArray();
      $writeitems = DB::table('write_tests')->whereTest_id("$id")->get()->toArray();
      $holeitems = DB::table('hole_tests')->whereTest_id("$id")->get()->toArray();

      $sum = array_merge($selectitems, $writeitems, $holeitems);

      $count_questions = count($sum);

      $sort = collect($sum);

      $sort = $sort->sortBy('question_number')->all();
      // dump($test);

      return view('testedit',
        [
          'count_questions' => $count_questions,
          'test' => $test,
          'test_id' => $id,
        ], compact('sort', 'count_questions'));

    }

    public function editRegister($id, Request $request)
    {

      $posttest = $request->all();
        $test = new Test;
        $write_test = new Write_test;
        $select_test = new Select_test;
        $hole_test = new Hole_test;


        // // 削除処理
        // $write_test->where('test_id', $id)->delete();
        // $select_test->where('test_id', $id)->delete();
        // $hole_test->where('test_id', $id)->delete();
        //
        // // テストテーブルの変更
        // // $test_data = $test->where('id', $id)->get();
        // $test_data = $test->where('id', $id)->first();
        // $testno = $test->where('id', $id)->value('id');
        // $test_data->title = $test_data->title;
        // $test_data->status = $request->status;
        // $test_data->updated_at = Carbon::now();
        // $test_data->save();
        // dump($testno);
        //
        //
        // // ここから下が変更
        // $surveyno = $request->input('id'); //問題数
        // for ($i=1; $i <= $surveyno; $i++) {
        //   $question_number[$i] = $i; //何問目か？
        //   $text1[$i] = $request->input("1text$i"); //１回答のテキスト
        //   // $answer_1[$i] = $request->input("1answer_$i"); //１回答の答え
        //
        //   $text2[$i] = $request->input("2text$i"); //穴埋めのテキスト
        //   $answer2_1[$i] = $request->input("2answer1_$i"); //穴埋めのテキスト
        //   $answer2_2[$i] = $request->input("2answer2_$i"); //穴埋めのテキスト
        //
        //   $text8[$i] = $request->input("8text$i"); //8択問題のテキスト
        //   $answer8_1[$i] = $request->input("8answer1_$i"); //１個目の答え
        //   $answer8_2[$i] = $request->input("8answer2_$i"); //１個目の答え
        //   $answer8_3[$i] = $request->input("8answer3_$i"); //１個目の答え
        //   $answer8_4[$i] = $request->input("8answer4_$i"); //１個目の答え
        //   $answer8_5[$i] = $request->input("8answer5_$i"); //１個目の答え
        //   $answer8_6[$i] = $request->input("8answer6_$i"); //１個目の答え
        //   $answer8_7[$i] = $request->input("8answer7_$i"); //１個目の答え
        //   $answer8_8[$i] = $request->input("8answer8_$i"); //１個目の答え
        //
        //   // ラジオボタン判定
        //   $choice8_1[$i] = $request->input("8choice1_$i"); //１個目の答え
        //   $choice8_2[$i] = $request->input("8choice2_$i"); //１個目の答え
        //   $choice8_3[$i] = $request->input("8choice3_$i"); //１個目の答え
        //   $choice8_4[$i] = $request->input("8choice4_$i"); //１個目の答え
        //   $choice8_5[$i] = $request->input("8choice5_$i"); //１個目の答え
        //   $choice8_6[$i] = $request->input("8choice6_$i"); //１個目の答え
        //   $choice8_7[$i] = $request->input("8choice7_$i"); //１個目の答え
        //   $choice8_8[$i] = $request->input("8choice8_$i"); //１個目の答え
        //
        //   if ( !empty($choice8_1[$i])) {
        //     $answer = 1;
        //     // dump($answer);
        //   }
        //   if ( !empty($choice8_2[$i])) {
        //     $answer = 2;
        //   }
        //   if ( !empty($choice8_3[$i])) {
        //     $answer = 3;
        //   }
        //   if ( !empty($choice8_4[$i])) {
        //     $answer = 4;
        //   }
        //   if ( !empty($choice8_5[$i])) {
        //     $answer = 5;
        //   }
        //   if ( !empty($choice8_6[$i])) {
        //     $answer = 6;
        //   }
        //   if ( !empty($choice8_7[$i])) {
        //     $answer = 7;
        //   }
        //   if ( !empty($choice8_8[$i])) {
        //     $answer = 8;
        //   }
        //
        //   // ラジオボタン判定短くできるかも？
        //   // for ($y=1; $y < 9; $y++) {
        //   //   // if ( !empty('$answer8_'. $y .'['. $i .']')) {
        //   //   if ( !empty($answer8_1[$i])) {
        //   //     $answer = $y;
        //   //     dump($answer);
        //   //   }
        //   // }
        //
        //   // dump($answer8_1[$i]);
        //   // dump($answer8_2[$i]);
        //   // dump($answer);
        //   if (!empty($text1[$i])) { //記述問題
        //     DB::table('write_tests')->insert([
        //       'test_id' => "$testno", //ok
        //       'question' => "$text1[$i]", //ok
        //       'question_number' => "$question_number[$i]", //ok
        //       'role' => '1',  //ロール権限 記述問題 //ok
        //       // 'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
        //       'updated_at' => Carbon::now(),  //時間が違う、場所の設定が違うのかも
        //     ]);
        //   } elseif ($text2[$i]) { //2択問題
        //     DB::table('hole_tests')->insert([
        //       'test_id' => "$testno", //ok
        //       'question' => "$text2[$i]", //ok
        //       'answer1' => "$answer2_1[$i]", // ok
        //       'answer2' => "$answer2_2[$i]", // ok
        //       'question_number' => "$question_number[$i]", //ok
        //       'role' => '3',  //ロール権限 穴埋め問題 ok
        //       // 'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
        //       'updated_at' => Carbon::now(),  //時間が違う、場所の設定が違うのかも
        //     ]);
        //   } elseif ($text8[$i]) {
        //     DB::table('select_tests')->insert([
        //       'test_id' => "$testno", //ok
        //       'question' => "$text8[$i]", //ok
        //       'answer' => "$answer", // ok
        //       'select1' => "1", // ok
        //       'select2' => "2", //
        //       'select3' => "3", //
        //       'select4' => "4", //
        //       'select5' => "5", //
        //       'select6' => "6", //
        //       'select7' => "7", //
        //       'select8' => "8", // ok
        //       'select_item1' => "$answer8_1[$i]", // ok
        //       'select_item2' => "$answer8_2[$i]", //
        //       'select_item3' => "$answer8_3[$i]", //
        //       'select_item4' => "$answer8_4[$i]", //
        //       'select_item5' => "$answer8_5[$i]", //
        //       'select_item6' => "$answer8_6[$i]", //
        //       'select_item7' => "$answer8_7[$i]", //
        //       'select_item8' => "$answer8_8[$i]", // ok
        //       'question_number' => "$question_number[$i]", //ok
        //       'role' => '1',  //ロール権限 洗濯問題 ok
        //       // 'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
        //       'updated_at' => Carbon::now(),  //時間が違う、場所の設定が違うのかも
        //     ]);
        //   }
        // }



        // 画面遷移用
        // return view('testedit',
        //   // [
        //   //   // 'count_questions' => $count_questions,
        //   //   // 'test' => $test,
        //   //   // 'test_id' => $id,
        //   // ], compact('sort', 'count_questions')
        // );

    }
}
