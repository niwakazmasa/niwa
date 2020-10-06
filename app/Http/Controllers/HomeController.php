<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function index()
    {
      return view('home');
    }

    // ログアウト処理
    public function getLogout()
    {
      Auth::logout();
      return redirect()->route('login');
    }
}
