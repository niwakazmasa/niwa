<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    // ユーザー情報登録
    public function registerUser($slack_name, $slack_id, $slack_mail, $slack_image)
    {
        $user = new User();
        $user->slack_name = $slack_name;
        $user->slack_id = $slack_id;
        $user->slack_mail = $slack_mail;
        $user->slack_image = $slack_image;
        $user->password = Hash::make('kjikboRERTFKU98hg');
        $user->save();
    }

    public function getUserUnscored(int $user_id)
    {
        return User::find($user_id);
    }

    public function searchUser($keyword)
    {
        return User::where('slack_name','like','%'.$keyword.'%')->get();
    }
}
