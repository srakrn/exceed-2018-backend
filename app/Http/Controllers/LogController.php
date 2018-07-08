<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function query($key_1, $key_2){
        return \App\Logger::where('key_1', '=', $key_1)
            ->where('key_2', '=', $key_2)
            ->get();
    }

    public function latest($key_1, $key_2){
        $data = \App\Logger::where('key_1', '=', $key_1)
            ->where('key_2', '=', $key_2)
            ->orderBy('created_at', 'desc')
            ->first();
        if($data == ""){
            $data = array(
                'status' => 'error',
                'message' => 'No values of this key has been stored before.'
            );
        }
        return $data;
    }
}
