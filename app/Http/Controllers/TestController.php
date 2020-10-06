<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {


    // テスト表示処理　始まり
       //DBから情報持ってくる
       $test = new Test;
       //表示したいテストID持ってくる テストID＝$testnumber
       $testnumber = $test->where('id',1)->value('id'); //('id',1)の中の１は変数になる POSTされてきた
       $test_time = $test->where('id',1)->value('test_time'); //('id',1)の中の１は変数になる POSTされてきた
       $selectitems = DB::table('select_tests')->whereTest_id("$testnumber")->get()->toArray();
       $holeitems = DB::table('hole_tests')->whereTest_id("$testnumber")->get()->toArray();
       $writeitems = DB::table('write_tests')->whereTest_id("$testnumber")->get()->toArray();


       // user_idをとってくるSlackIDまでのつなぎ
       // $user_id = DB::table('users')->whereSlack_id("abc")->value('id');
       // $user_id = DB::table('users')->whereUser_id("1")->value('user_id');
       // $user_id = DB::table('users')->whereId(Auth::id(1))->value('id');

       //配列を合わせる
       $str3 = array_merge($selectitems, $holeitems, $writeitems);

       // collect（数字化？）
       $sorted = collect($str3);

       // テストのソート
       $sorteds = $sorted->sortBy('question_number')->all();
    // テスト表示処理　終わり



    // 　テストの答え格納　始まり
       //POSTされてきた情報
       $answers = $request->all(); //GETで送られてきたデータ
       // dump($answers);
       // 何問あるか？
       $count = $sorted->count('question_number');
       // 記述問題用
       // dump($answers);

       // 問題が正解か判定する
       if ( !empty($answers)) {
         $sum = 0; //採点用の変数
       for ($i = 1; $i <= "{$count}"; $i++){
         $scores = 0;
         $testanswer[$i] = $request->input("answer$i"); //生徒の回答
         if ( empty($testanswer[$i])) {
           $testanswer[$i] = "回答なし";
         }

         // 選択テスト
         // データ取得
         $b_answer[$i] = $request->input("b_answer$i"); //生徒の回答
         $question_answer[$i] = $request->input("question_answer$i"); //正解
         // 正解判定
         if ( !empty($question_answer[$i])) {
         if ($b_answer[$i] == $question_answer[$i]) {
           $b_judgment[$i] = "1"; //正解の場合は1
           $scores = 1;
         }
         else {
           $b_judgment[$i] = "2"; //不正解の場合は2
         }
         }

         // 穴埋め問題
         // データ取得
         $h_answer1_[$i] = $request->input("h_answer1_$i"); //生徒の1回答目
         $h_answer2_[$i] = $request->input("h_answer2_$i"); //生徒の2回答目
         $question_answer1_[$i] = $request->input("question_answer1_$i"); //正解
         $question_answer2_[$i] = $request->input("question_answer2_$i"); //正解
         $h_answer3_[$i] =  $h_answer1_[$i].$h_answer2_[$i]; //生徒の回答結合
         // 正解判定
         if ( !empty($question_answer1_[$i] && $question_answer2_[$i])) {
         if ($h_answer1_[$i] == $question_answer1_[$i] && $h_answer2_[$i] == $question_answer2_[$i]) {
           $b_judgment[$i] = "1"; //正解の場合は1
           $scores = 1;
         }
         else {
           $b_judgment[$i] = "2"; //不正解の場合は2
         }
         }




         $role = $request->input("question$i"); //問題ロール判定選択、穴埋め、記述

            // 回答の配列　if文で登録先変える
            if ($role == 1) { //記述問題
              // DB::table('write_answers')->insert([
              //   'user_id' => "$user_id", //SlackIDじゃないと入らない
              //   'test_id' => "$testnumber", // ok
              //   'question_number' => "$i", //ok
              //   'answer' => "$testanswer[$i]",  //生徒の回答　ok
              //   'Judgment' => "3", //正解かどうか
              //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
              //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも
              }

            if ($role == 2) { //選択問題
              // dump($b_judgment[$i]);
              if ( empty($b_answer[$i])) {
                $b_answer[$i] = "22";
              }
              // DB::table('select_answers')->insert([
              //   'user_id' => "$user_id", //SlackIDじゃないと入らない ok
              //   'test_id' => "$testnumber", //ok
              //   'question_number' => "$i", //ok
              //   'answer' => "$b_answer[$i]", //  ok
              //   'Judgment' => "$b_judgment[$i]", //正解かどうか ok
              //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
              //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも
            }

              if ($role == 3) { //穴埋め問題
                // DB::table('hole_answers')->insert([
                //   'user_id' => "$user_id", //SlackIDじゃないと入らないok
                //   'test_id' => "$testnumber", //ok
                //   'question_number' => "$i", //ok
                //   'answer' => "$h_answer3_[$i]", //生徒の回答　ok
                //   'Judgment' => "$b_judgment[$i]", //正解かどうか ok
                //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
                //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも
                }

                // 点数をだす
                  $sum = $sum + $scores;
       };
       // 点数をだす
       $correctcount = $sum; //2問正解
       }

       // 点数登録
       // if ( isset ( $correctcount ) ) {
         // dump($sum);
         // DB::table('test_results')->insert([
         //   'user_name' => 'slackOauth', //とりあえず入れてる
         //   'test_id' => "$testnumber",
         //   'score' => "$correctcount",
         //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
         //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも

         // DB::table('test_results')->insert([
         //   'user_name' => 'slackOauth', //とりあえず入れてる
         //   'test_id' => "$testnumber",
         //   'score' => "$correctcount",
         //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
         //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも

         // return redirect()->route('testend'); //テスト完了画面に遷移
       // }

       // 　テストの答え格納　終わり
// >>>>>>> slackOauth

         // return view('testend'); //テスト完了画面に遷移
       // }

       // 　テストの答え格納　終わり



       return view('test',compact('sorteds', 'test_time'));
    }
}
