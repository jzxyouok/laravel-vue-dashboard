<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Artisan;

class GoogleOAuth2CallBackController extends Controller
{
    public function oauth2CallBackReceivedCode(Request $request)
    {
        abort_unless($this->requestResponseIsValid($request), 401);

        // Artisan::call('dashboard:task');
// dd($request);
        echo $request->code;
    }

    public function requestResponseIsValid($request) : string
    {
        return isset($request->code);
    }
}
