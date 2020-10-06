<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\TestService;
use App\Http\Requests\CreateTest;

class TestcreateController extends Controller
{

    protected $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    //Request 引数でブレードで送ったものを取得して引数に入れる
    public function index(Request $request)
    {
        if ( isset ( $surveyno ) ) {
          // return view('testlist'); //テスト作成完了ごの画面に遷移
        }



       return view('testcreate');
    }

    public function create(CreateTest $request)
    {
        // 参考処理
        $posttest = $request->all();
        $test_title = $request->input('title');
        $test_status = $request->input('status');
        $testus = (int)$test_status;
        $test_time = $request->input('test_time');
        $tes = (int)$test_time;

        // テストテーブル登録処理
        $this->testService->createTest($request);


        //問題の保存
        $testno = DB::table('tests')->max('id'); //テストの番号　撮り方の選定があまい
        $surveyno = $request->input('id'); //問題数
        // dump($testno);
        for ($i=1; $i <= $surveyno; $i++) {
          $question_number[$i] = $i; //何問目か？
          $text1[$i] = $request->input("1text$i"); //１回答のテキスト
          // $answer_1[$i] = $request->input("1answer_$i"); //１回答の答え

          $text2[$i] = $request->input("2text$i"); //穴埋めのテキスト
          $answer2_1[$i] = $request->input("2answer1_$i"); //穴埋めのテキスト
          $answer2_2[$i] = $request->input("2answer2_$i"); //穴埋めのテキスト

          $text8[$i] = $request->input("8text$i"); //8択問題のテキスト
          $answer8_1[$i] = $request->input("8answer1_$i"); //１個目の答え
          $answer8_2[$i] = $request->input("8answer2_$i"); //１個目の答え
          $answer8_3[$i] = $request->input("8answer3_$i"); //１個目の答え
          $answer8_4[$i] = $request->input("8answer4_$i"); //１個目の答え
          $answer8_5[$i] = $request->input("8answer5_$i"); //１個目の答え
          $answer8_6[$i] = $request->input("8answer6_$i"); //１個目の答え
          $answer8_7[$i] = $request->input("8answer7_$i"); //１個目の答え
          $answer8_8[$i] = $request->input("8answer8_$i"); //１個目の答え

          // ラジオボタン判定
          $choice8_1[$i] = $request->input("8choice1_$i"); //１個目の答え
          $choice8_2[$i] = $request->input("8choice2_$i"); //１個目の答え
          $choice8_3[$i] = $request->input("8choice3_$i"); //１個目の答え
          $choice8_4[$i] = $request->input("8choice4_$i"); //１個目の答え
          $choice8_5[$i] = $request->input("8choice5_$i"); //１個目の答え
          $choice8_6[$i] = $request->input("8choice6_$i"); //１個目の答え
          $choice8_7[$i] = $request->input("8choice7_$i"); //１個目の答え
          $choice8_8[$i] = $request->input("8choice8_$i"); //１個目の答え

          if ( !empty($choice8_1[$i])) {
            $answer = 1;
            // dump($answer);
          }
          if ( !empty($choice8_2[$i])) {
            $answer = 2;
          }
          if ( !empty($choice8_3[$i])) {
            $answer = 3;
          }
          if ( !empty($choice8_4[$i])) {
            $answer = 4;
          }
          if ( !empty($choice8_5[$i])) {
            $answer = 5;
          }
          if ( !empty($choice8_6[$i])) {
            $answer = 6;
          }
          if ( !empty($choice8_7[$i])) {
            $answer = 7;
          }
          if ( !empty($choice8_8[$i])) {
            $answer = 8;
          }

          // ラジオボタン判定短くできるかも？
          // for ($y=1; $y < 9; $y++) {
          //   // if ( !empty('$answer8_'. $y .'['. $i .']')) {
          //   if ( !empty($answer8_1[$i])) {
          //     $answer = $y;
          //     dump($answer);
          //   }
          // }


          if (!empty($text1[$i])) { //記述問題
            DB::table('write_tests')->insert([
              'test_id' => $testno + 1,
              'question' => "$text1[$i]",
              'question_number' => "$question_number[$i]",
              'role' => '1',  //ロール権限 記述問題
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          } elseif ($text2[$i]) { //2択問題
            DB::table('hole_tests')->insert([
              'test_id' => $testno + 1,
              'question' => "$text2[$i]",
              'answer1' => "$answer2_1[$i]",
              'answer2' => "$answer2_2[$i]",
              'question_number' => "$question_number[$i]",
              'role' => '3',  //ロール権限 穴埋め問題
              'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
              'updated_at' => Carbon::now(),  //時間が違う、場所の設定が違うのかも
            ]);
          } elseif ($text8[$i]) {
            DB::table('select_tests')->insert([
              'test_id' => $testno + 1,
              'question' => "$text8[$i]",
              'answer' => "$answer",
              'select1' => "1",
              'select2' => "2",
              'select3' => "3",
              'select4' => "4",
              'select5' => "5",
              'select6' => "6",
              'select7' => "7",
              'select8' => "8",
              'select_item1' => "$answer8_1[$i]",
              'select_item2' => "$answer8_2[$i]",
              'select_item3' => "$answer8_3[$i]",
              'select_item4' => "$answer8_4[$i]",
              'select_item5' => "$answer8_5[$i]",
              'select_item6' => "$answer8_6[$i]",
              'select_item7' => "$answer8_7[$i]",
              'select_item8' => "$answer8_8[$i]",
              'question_number' => "$question_number[$i]",
              'role' => '1',  //ロール権限 洗濯問題
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ]);
          }

        }


        return redirect()->route('testlist');
    }
}
