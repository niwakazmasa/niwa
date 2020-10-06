<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test_result;
use App\Models\Test;
use App\Models\User;
use App\Models\Survey;
use App\Models\Select_survey_answer;
use App\Models\Write_survey_answer;



class Student_detailsController extends Controller
{

    public function index($name, Request $request){

    $test_result = new Test_result;
    $user = new User;
    $survey = new Survey;
    $Test = new Test;
    $write_survey_answer = new Write_survey_answer;


    //if文を書くと変数が無くなる
    $users_db=[];
    $surveys_db=[];


    //surveyじゃないときは全部出す
        $users_db = $test_result
        ->join('tests', 'tests.id', '=', 'test_results.test_id')
        // ->where('test_results.user_name', $request->input('name'))
        ->where('test_results.user_name', $name)
        ->get();

    //testじゃないときは全部出す。
    // if($request->input('mode')!='test'){
      //nameをいったんデータベースで検索にわは何番か調べているでにわが一番
      $users_list = $user
      ->where('slack_name', $name)
      ->get();

      //選択形式と穴埋めを一つにしてアンケートidをユーザーidで検索している

      $surveys_db = $survey
        ->leftjoin('select_survey_answers', 'surveys.id', '=', 'select_survey_answers.survey_id')
        ->leftjoin('write_survey_answers', 'surveys.id', '=', 'write_survey_answers.survey_id')
        ->where('select_survey_answers.user_id', $users_list[0]->id)
        ->orWhere('write_survey_answers.user_id', $users_list[0]->id )
        ->select('surveys.id')
        ->groupBy('surveys.id')
        ->get();

      //idの検索結果をforeachで回して取得して
      $survey_id_list=[];
      foreach($surveys_db as $key => $survey){
        array_push($survey_id_list,$survey->id);
      }
      //idのlistをもとにタイトルを取得している
      $surveys_db = $survey
      ->whereIn('id', $survey_id_list)
      ->get();



    // }


    // dump($test_result);
    // dump($users_db);
    return view('student_details',compact('users_db','surveys_db'));

    }

}
