<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;



class SurveylistController extends Controller
{
    //
    public function index(){
        
        $survey_list=new Survey;
        $dblist = $survey_list
        ->get();

        return view('surveylist',compact('dblist'));



    }
}
