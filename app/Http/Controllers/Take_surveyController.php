<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Take_surveyController extends Controller
{
    //
    public function index(Request $request)
    {
       // アンケート受講
       $surveys = new Survey;
       $postsurvey = $request->all();


       //表示したいアンケートID持ってくる アンケートID＝$testnumber
       $surveynumber = $surveys->where('id',1)->value('id'); //('id',1)の中の１は変数になる POSTされてきた
       $selectitems = DB::table('select_surveys')->whereSurvey_id("$surveynumber")->get()->toArray();
       $writeitems = DB::table('write_surveys')->whereSurvey_id("$surveynumber")->get()->toArray();

       // user_idをとってくるSlackIDまでのつなぎ
       $user_id = DB::table('users')->whereSlack_id("abc")->value('id');

       //配列を合わせる
       $str2 = array_merge($selectitems, $writeitems);

       // collect（数字化？）
       $sorted = collect($str2);

       // アンケートのソート
       $sorteds = $sorted->sortBy('question_number')->all();
       dump($sorteds);
       // アンケート表示処理　終わり


       //アンケートの答え格納　始まり
       //POSTされてきた情報
       $answers = $request->all(); //GETで送られてきたデータ
       // 何問あるか？
       $count = $sorted->count('question_number');
       // アンケート判定
       if (!empty($answers)) {

       for ($i = 1; $i <= "{$count}"; $i++){
         $role[$i] = $request->input("role$i"); //ロール権限
         // 記述アンケートのデータ取得
         $test_answer[$i] = $request->input("answer$i"); //回答

         // 選択アンケートのデータ取得
         $b_answer[$i] = $request->input("b_answer$i"); //回答
         if ( empty($b_answer[$i])) {
           $b_answer[$i] = "3"; //回答なしの場合は３
         }
         // 問題文の取得
         $text_question[$i] = $request->input("text_question$i");
          // ラジオボタンの文章
          $role[$i] = $request->input("role$i"); //回答
          $q = $b_answer[$i]; //ラジオボタンの回答番号
          if ($role[$i] == 2 && $q != 3) {
            $b_answer_item[$i] = DB::table('select_surveys')->where('question_number',$i)->value("select_item$q");
          }

         // dump($role[$i]);

       if ($role[$i] == 1) { //記述アンケート
         if ($test_answer[$i] === "回答なし") {
           $test_answer[$i] = "22";
         }
         // DB::table('write_survey_answers')->insert([
         //   'user_id' => "$user_id", //SlackIDに変更する  ok
         //   'survey_id' => "$surveynumber",
         //   'question_number' => "$i",
         //   'answer' => "$test_answer[$i]", //選択問題の回答じゃないと入らないのであとで入れる
         //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
         //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも
         //   dump($role[$i]);
         }
       //
       if ($role[$i] == 2) { //選択アンケート
         // DB::table('select_survey_answers')->insert([
         //   'user_id' => "$user_id", //SlackIDに変更する  ok
         //   'survey_id' => "$surveynumber",
         //   'question_number' => "$i",
         //   'answer' => "$b_answer[$i]",
         //   'answer_item' => "$b_answer_item[$i]",
         //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
         //   'updated_at' => Carbon::now()]); //時間が違う、場所の設定が違うのかも
         //   dump($role[$i]);
         }

         if ($i == $count) {
           // return view('surveyend'); //アンケート完了画面に遷移
         }

     }
     }












       return view('take_survey',compact('sorteds'));
    }
}
