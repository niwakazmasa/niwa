<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
// use Illuminate\Http\Request;

class Survey extends Model
{
    // // 元表示
    // protected $table = 'surveys';
    // protected $primaryKey = 'id';

    // item参考
    protected $fillable = [
        'title',
        'status',
    ];

    // public function write_survey()
    // {
    //     return $this->hasMany(Write_survey::class);
    // }

}
