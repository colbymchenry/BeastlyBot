<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use League\OAuth2\Client\Token\AccessToken;
use Wohali\OAuth2\Client\Provider\Discord;

class AlertHelper
{

    public static function alertSuccess(string $message): void {
        Session::put('alert', ['type' => 'success', 'msg' => $message]);
    }

    public static function alertError(string $message): void {
        Session::put('alert', ['type' => 'error', 'msg' => $message]);
    }

    public static function alertWarning(string $message): void {
        Session::put('alert', ['type' => 'warning', 'msg' => $message]);
    }

    public static function alertInfo(string $message): void {
        Session::put('alert', ['type' => 'info', 'msg' => $message]);
    }

    public static function alertQuestion(string $message):void {
        Session::put('alert', ['type' => 'question', 'msg' => $message]);
    }

}
