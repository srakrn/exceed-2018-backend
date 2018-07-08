<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function query($key_1, $key_2){
        return \App\Logger::where('key_1', '=', $key_1)
            ->where('key_2', '=', $key_2)->get();
    }
}
