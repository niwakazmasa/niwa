<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
// use Illuminate\Http\Request;

class Write_survey extends Model
{
    // item参考
    protected $fillable = [
        'question',
        'question_number',
    ];

    // public function survey()
    // {
    //     return $this->belongsTo(Survey::class);
    // }

}
