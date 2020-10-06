<?php
namespace App\Http\Controllers;
use Socialite;
class OAuthController extends Controller
{

    // Slack認証へ遷移
    public function redirectToProvider()
    {
        return Socialite::driver('slack')->redirect();
    }
    // Slackからのリダイレクト
    public function handleProviderCallback()
    {
        $user = Socialite::driver('slack')->stateless()->user();
        dump($user);
        return view('login2', ['user' => $user]);
    }
}
