<?php

namespace App\Http\Controllers;

class MonitorController extends Controller
{
    public function index()
    {
        $pusherKey = config('broadcasting.connections.pusher.key');

        return view('monitor')->with(compact('pusherKey'));
    }
}
