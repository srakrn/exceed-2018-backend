<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoKeyLogController extends Controller
{
    public function query($key_1, $key_2, Request $request){
        $data = \App\Logger::where('key_1', '=', $key_1)
            ->where('key_2', '=', $key_2)
            ->orderBy('id', 'desc');
        if(isset($request['before'])){
            $before = (int)$request['before'];
            $data = $data->where('id', '<', $before);
        }
        if(isset($request['after'])){
            $after = (int)$request['after'];
            $data = $data->where('id', '>', $after);
        }
        if(isset($request['limit'])){
            $limit = (int)$request['limit'];
            if($limit > 100){
                $limit = 100;
            }
        }
        else{
            $limit = 10;
        }
        return $data->take($limit)->get();
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

    public function latestValue($key_1, $key_2){
        $data = \App\Logger::where('key_1', '=', $key_1)
            ->where('key_2', '=', $key_2)
            ->orderBy('created_at', 'desc')
            ->first();
        if($data == ''){
            return '';
        }
        return $data->value;
    }

    public function set($key_1, $key_2, Request $request){
        if(isset($request['value'])){
            $logger = new \App\Logger;
            $logger->key_1 = $key_1;
            $logger->key_2 = $key_2;
            $logger->value = $request;
            $logger->save();
            $data = array(
                'status' => 'success'
            );
        }
        else{
            $data = array(
                'status' => 'error',
                'message' => 'no value defined'
            );
        }
        return $data;
    }

    public function keys($key_1){
        $data = \App\Logger::where('key_1', '=', $key_1)
            ->select('key_2')->get();
        $plucked = $data->pluck('key_2')->unique();
        return $plucked->all();
    }
}
