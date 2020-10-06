<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    //urlの結果を取得 submitした内容をRequestで取得
    public function index(Request $request)
    {

        $student=new user;

        $inputlist=["keyword"=>$request->input('keyword')];

        //urlの結果を取得
        if( empty($request->input('keyword'))){
            $dblist = $student
            ->get();
        }else{
             
             $dblist = $student
             //user_nameと検索で表示したデータを取得
             ->where('name','like','%'.$request->input('keyword').'%')
             ->get();

        }



        //使いたい変数をコンパクトセットで送る
        return view('student',compact('dblist','inputlist'));

    }
}
