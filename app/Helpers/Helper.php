<?php

namespace App\Helpers;

use App\Log;
use Request;

class Helper
{
    public static function log($success, $message = '')
    {
        Log::create([
            'ip' => Request::getClientIp(),
            'function' => debug_backtrace()[1]['function'],
            'success' => $success,
            'message' => $message,
        ]);
    }
}
