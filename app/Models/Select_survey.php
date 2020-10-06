<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
// use Illuminate\Http\Request;

class Select_survey extends Model
{
    // item参考
    protected $fillable = [
        'question',
        'question_number',
    ];

}
