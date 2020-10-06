<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class schoolsController extends Controller
{
    public function index(){
    	echo "test";
        return view('login');

    }

    public function login() {
        echo"login";

    }


    public function show(){
    return view('welcome');
    
}
}