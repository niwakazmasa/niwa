<?php

namespace App\Services;

use GuzzleHttp\Client;

class SlackApi
{

    private const ACCESSTOKEN_GET_API_URL = 'https://slack.com/api/oauth.access/';
    private const USERINFO_SEARCH_API_URL = 'https://slack.com/api/users.info/';

    // スラックのアクセストークン取得
    public function getAcsesstoken($code)
    {

        $client = new Client();

        $response = $client
            ->get(self::ACCESSTOKEN_GET_API_URL, [
                'query' => [
                    'client_id' => env('SLACK_CLIENT_ID'),
                    'client_secret' => env('SLACK_CLIENT_SECRET'),
                    'code' => $code,
                ],
                'http_errors' => false,
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    // ユーザー情報の検索
    public function seachUserInfo($token, $user)
    {

        $client = new Client();

        $response = $client
            ->get(self::USERINFO_SEARCH_API_URL, [
                'query' => [
                    'token' => $token,
                    'user' => $user,
                ],
                'http_errors' => false,
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}
