<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Write_survey;
use App\Models\Select_survey;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SurveyController extends Controller
{
    // // 元表示
    // public function index()
    // {
    //    return view('survey');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    public function index(Request $request)
    {

        $user_role = 3;
        // $user_role = Auth::user()->role;

        $surveys = new Survey;

        if ($request->status == 2) {
            $status = 2;
            $dblist = $surveys
            ->where('status',2)
            ->get();
        }else {
            $status = 1;
            $dblist = $surveys
            ->where('status',1)
            ->get();
        }

        return view('survey.index',[
          'dblist' =>$dblist,
          'status' => $status,
          'surveys' => $surveys,
          'user_role' => $user_role,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     // storeはPOSTで送信される
     //新規作成ページ用
    public function store(Request $request)
    {


        // 参考処理
        $survey = new Survey;
        $postsurvey = $request->all();
        // アンケート登録してから問題の保存
        $surveyno = $request->input('ak_title');
        $surveystatus = $request->input('status');
        // DB::table('surveys')->insert([
        //   'title' => "$surveyno", //SlackIDじゃないと入らない
        //   'status' => "$surveystatus",
        //   'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
        //   'updated_at' => Carbon::now()  //時間が違う、場所の設定が違うのかも
        // ]);


        //問題の保存
        $surveysno = DB::table('surveys')->max('id');

        $surveyno = $request->input('id');
        // dump($surveysno);
        for ($i=1; $i <= $surveyno; $i++) {
          //survey_id　アンケート自体のID　登録完了してから入れる
          $choice_text[$i] = $request->input("choice_text$i");
          $describing_text[$i] = $request->input("describing_text$i");
          $role[$i] = $request->input("role$i");
          $question_number[$i] = $i;
          $yes_answer[$i] = $request->input("yes_answer$i");
          $no_answer[$i] = $request->input("no_answer$i");
          if (!empty($choice_text[$i])) { //選択式アンケート2択　select　
            DB::table('select_surveys')->insert([
              'survey_id' => $surveysno + 1, //ok
              'question' => "$choice_text[$i]", //ok
              'question_number' => "$question_number[$i]", //ok
              'role' => "$role[$i]", //ok
              'select1' => "1", //ok
              'select2' => "2", //ok
              'select_item1' => "$yes_answer[$i]", //ok
              'select_item2' => "$no_answer[$i]", //ok
              'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
              'updated_at' => Carbon::now()  //時間が違う、場所の設定が違うのかも
            ]);
          } else { //記述式アンケート登録　write ok
            DB::table('write_surveys')->insert([
              'survey_id' => $surveysno + 1, //ok
              'question' => "$describing_text[$i]", //ok
              'question_number' => "$question_number[$i]", //ok
              'role' => "$role[$i]", //ok
              'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
              'updated_at' => Carbon::now()  //時間が違う、場所の設定が違うのかも
            ]);
          }
        }





        // route('survey.index')の列にあとで戻す
        return view('survey.create',compact('postsurvey'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

      // if ($request) {
      //     dump($request);
      // }

      $survey = Survey::find($id);
      $selectitems = DB::table('select_surveys')->whereSurvey_id("$id")->get()->toArray();
      $writeitems = DB::table('write_surveys')->whereSurvey_id("$id")->get()->toArray();
      $selectitemss = DB::table('select_survey_answers')->whereSurvey_id("$id")->get()->toArray();
      $writeitemss = DB::table('write_survey_answers')->whereSurvey_id("$id")->get()->toArray();

      $sum = array_merge($selectitems, $writeitems);
      $sums = array_merge($selectitemss, $writeitemss);

      $count_questions = count($sum);

      $sort = collect($sum);
      $sorts = collect($sums);

      $sort = $sort->sortBy('question_number')->all();
      $sorts = $sorts->sortBy('question_number')->all();
      dump($sort);

      return view('survey.show',
        [
          'count_questions' => $count_questions,
          'survey' => $survey,
          'survey_id' => $id,
        ], compact('sort', 'sorts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::find($id);
        $write_survey2 = Write_survey::where('survey_id', $id)->get()->toArray();
        $select_survey2 = Select_survey::where('survey_id', $id)->get()->toArray();
        $write_survey = Write_survey::where('survey_id', $id)->get();
        $select_survey = Select_survey::where('survey_id', $id)->get();


        //配列を合わせる
        $str2 = array_merge($write_survey2, $select_survey2);

        $count_questions = count($str2);

        // collect（数字化？）
        $sorted = collect($str2);

        // アンケートのソート
        $sorteds = $sorted->sortBy('question_number')->all();
        dump($sorteds);
        // dump(is_array ( $sorteds));
        // is_array ( $sorteds);
        // アンケート表示処理　終わり


        //確認用
        // dump($write_survey);
        // 初期記入方法
        return view('survey.edit',
          [
            'survey' => $survey,
            'write_surveys' => $write_survey,
            'select_surveys' => $select_survey,
          ],
          compact('sorteds', 'count_questions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $postak = $request->all();
      dump($postak);
        $survey = new Survey;
        $write_survey = new Write_survey;
        $select_survey = new Select_survey;

        // 削除処理
        $write_survey->where('survey_id', $id)->delete();
        $select_survey->where('survey_id', $id)->delete();

        // surveyテーブルの変更
        $survey_data = $survey->where('id', $id)->first();
        $surveysno = $survey->where('id', $id)->value('id');
        $survey_data->title = $request->title;
        $survey_data->status = $request->status;
        $survey_data->updated_at = Carbon::now();
        $survey_data->save();


        // ここから下が変更
        $surveyno = $request->input('id');
        // dump($surveysno);
        for ($i=1; $i <= $surveyno; $i++) {
          $question_number[$i] = $i; //何問目か？
          $choice_text[$i] = $request->input("choice_text$i");
          $describing_text[$i] = $request->input("describing_text$i");
          $role[$i] = $request->input("role$i");
          $question_number[$i] = $i;
          $yes_answer[$i] = $request->input("yes_answer$i");
          $no_answer[$i] = $request->input("no_answer$i");
          // dump($yes_answer[$i]);
          // dump($surveysno);
          if (!empty($choice_text[$i])) { //選択式アンケート2択　select　
            // DB::table('select_surveys')->insert([
            //   'survey_id' => "$surveysno", //ok
            //   'question' => "$choice_text[$i]", //ok
            //   'question_number' => "$question_number[$i]", //ok
            //   'role' => "$role[$i]", //ok
            //   'select1' => "1", //ok
            //   'select2' => "2", //ok
            //   'select_item1' => "$yes_answer[$i]", //ok
            //   'select_item2' => "$no_answer[$i]", //ok
            //   // 'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
            //   'updated_at' => Carbon::now()  //時間が違う、場所の設定が違うのかも
            // ]);
          } else { //記述式アンケート登録　write ok
            // DB::table('Write_surveys')->insert([
            //   'survey_id' => "$surveysno", //ok
            //   'question' => "$describing_text[$i]", //ok
            //   'question_number' => "$question_number[$i]", //ok
            //   'role' => "$role[$i]", //ok
            //   // 'created_at' => Carbon::now(), //時間が違う、場所の設定が違うのかも
            //   'updated_at' => Carbon::now()  //時間が違う、場所の設定が違うのかも
            // ]);
          }
        }

        // 黒木さんが作った処理　一旦使っていない
        // foreach ($request->request as $key) {
        //     // $requestの'_token'以外を使う
        //     if ($key != '_token') {
        //         // view側でroleの値も取得できるようにする
        //         if ('role == 1') {
        //             $write_survey->survey_id = $id;
        //             $write_survey->question = $key->question;
        //             $write_survey->question_number = $key->question_number;
        //             $write_survey->save();
        //
        //         }elseif ('role == 2') {
        //             $select_survey->test_id = $id;
        //             $select_survey->question = $key->question;
        //             $select_survey->answer = $key->answer;
        //             $select_survey->select_item1 = $key->Choice1;
        //             $select_survey->select_item2 = $key->Choice2;
        //             $select_survey->select_item3 = $key->Choice3;
        //             $select_survey->select_item4 = $key->Choice4;
        //             // 8択問題だった時に追加する処理
        //             if (array_key_exists( 'Choice5', $key )) {
        //                 $select_survey->select_item5 = $key->Choice5;
        //                 $select_survey->select_item6 = $key->Choice6;
        //                 $select_survey->select_item7 = $key->Choice7;
        //                 $select_survey->select_item8 = $key->Choice8;
        //             }
        //             $select_survey->question_number = $key->question_number;
        //             $select_survey->save();
        //
        //         }
        //     }
            // }
        // }
        // $update = [
        //     'title' => $request->title,
        //     'status' =>$request->status
        // ];
        // Survey::where('id', $id) >update($update);
        // return back()->with('success', '編集完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Survey::where('id', $id)->delete();
        return redirect()->route('survey.index')->with('success', '削除しました');
    }
}
