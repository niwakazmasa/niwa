<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;


class TestlistController extends Controller
{
    //
    public function index(Request $request)
    {
        // ログインしているユーザーのロールを判断
        // 本来は Auth::user()->role の方を使う
        $user_role = Auth::user()->role;

        $test = new Test;
        if ($request->status == 2) {
            $status = 2;
            $dblist = $test
            ->where('status',2)
            ->get();
        }else {
            $status = 1;
            $dblist = $test
            ->where('status',1)
            ->get();
        }
        //ブレードへ
        return view('testlist',[
            'dblist' =>$dblist,
            'status' => $status,
            'user_role' => $user_role,
        ]);
    }

    // 削除処理
    public function delete(Request $request)
    {
        Test::find($request->id)->delete();
        return redirect('/testlist');
    }
}
