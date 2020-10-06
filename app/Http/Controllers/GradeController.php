<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\TestService;
use App\Services\Write_answerService;
use App\Services\Write_testService;

class GradeController extends Controller
{

    protected $userService;
    protected $testService;
    protected $write_answerService;
    protected $write_testService;

    public function __construct(UserService $userService, TestService $testService, Write_answerService $write_answerService, Write_testService $write_testService)
    {
        $this->testService = $testService;
        $this->write_answerService = $write_answerService;
        $this->userService = $userService;
        $this->write_testService = $write_testService;
    }

    public function index(Request $request)
    {
        // 未採点の記述テスト取得
        $unscored_tests = $this->write_answerService->getUnscored();

        $data = array();
        $i = 0;
        $ii = 0;
        // 検索フォームに入力があるか確認
        if ($request->keyword === null) {
            // 未採点の記述テスト、その解答、回答した生徒を配列にしてまとめる
            foreach ($unscored_tests as $unscored_test) {
                $i++;
                $user = $this->userService->getUserUnscored($unscored_test->user_id);
                $test = $this->testService->getTestUnscored($unscored_test->test_id);

                if($i==1){
                    $data[] = array('name' => $user->slack_name, 'test_title' => $test->title, 'write_test_id' => $unscored_test->id, 'test_id' => $unscored_test->test_id, 'user_id' => $unscored_test->user_id);
                }else{
                    foreach ($data as $value) {
                          // 重複チェック
                        if ($value['name'] == $user->slack_name && $value['test_id'] == $unscored_test->test_id) {
                            $ii++;
                        }
                    }
                    if ($ii == 0) {
                        $data[] = array('name' => $user->slack_name, 'test_title' => $test->title, 'write_test_id' => $unscored_test->id, 'test_id' => $unscored_test->test_id, 'user_id' => $unscored_test->user_id);
                    }
                }
            }
        } else {
            foreach ($unscored_tests as $unscored_test) {
                $i++;
                $user = $this->userService->getUserUnscored($unscored_test->user_id);
                $test = $this->testService->getTestUnscored($unscored_test->test_id);
                // 検索フォームからユーザーを検索
                $seach_name = $this->userService->searchUser($request->keyword);

                foreach ($seach_name as $value) {
                    if ($value->slack_name == $user->slack_name) {
                        if($i==1){
                            $data[] = array('name' => $user->slack_name, 'test_title' => $test->title, 'write_test_id' => $unscored_test->id, 'test_id' => $unscored_test->test_id, 'user_id' => $unscored_test->user_id);
                        }else{
                            foreach ($data as $value) {
                                  // 重複チェック
                                if ($value['name'] == $user->slack_name && $value['test_id'] == $unscored_test->test_id) {
                                    $ii++;
                                }
                            }
                            if ($ii == 0) {
                                $data[] = array('name' => $user->slack_name, 'test_title' => $test->title, 'write_test_id' => $unscored_test->id, 'user_id' => $unscored_test->user_id);
                            }
                        }
                    }
                }
            }
        }
        return view('grade.index', [
            'unscored_data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新規作成未使用
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //新規作成未使用
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditForm(int $id, int $user_id, Request $request)
    {
        $write_answer = $this->write_answerService->getWriteAnswer($id);
        $user = $this->userService->getUserUnscored($write_answer->user_id);
        $test = $this->testService->getTestUnscored($write_answer->test_id);

        $users_write_answers = $this->write_answerService->getUsersWriteAnswer($write_answer->user_id, $write_answer->test_id);

        // ユーザーが回答した内容とそのテスト問題の内容を配列にまとめる
        $data = array();
        foreach ($users_write_answers as $users_write_answer) {
            $write_test = $this->write_testService->serchTest($users_write_answer->test_id, $users_write_answer->question_number);

            foreach ($write_test as $value) {
              $data[] = array('write_answer_id' => $users_write_answer->id, 'question' => $value->question, 'question_number' => $users_write_answer->question_number, 'users_answer' => $users_write_answer->answer);
            }
        }

        return view('grade.edit', [
            'user_name' => $user->slack_name,
            'test_title' => $test->title,
            'unscored_data' => $data,
            'test_id' => $id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, int $user_id, Request $request)
    {
        // 記述問題の正誤判定処理
        foreach ($request->request as $key => $value) {
            if (is_int($key)) {
                $question_number = $key;
                $judgment = intval($value);

                $edit_data = $this->write_answerService->getEditWriteAnswer($user_id, $id, $question_number);
                foreach ($edit_data as $key => $value) {
                    $this->write_answerService->editWrite_answer($value, $judgment);
                }
            }
        }

        return redirect()->route('grade.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //削除機能未使用
    }
}
