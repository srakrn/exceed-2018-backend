<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function by_id($id){
        $data = \App\Logger::find($id);
        return $data;
    }

    public function query($key, Request $request){
        $max_limit = intval(\App\Preference::find('max_history_limit')->value);
        $data = \App\Logger::where('key_1', '=', 'exceed_2018')
            ->where('key_2', '=', $key)
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
            if($limit > $max_limit){
                $limit = $max_limit;
            }
        }
        else{
            $limit = 10;
        }
        $data = $data->take($limit)->get();
        $sanitize = (\App\Preference::find('sanitize_results')->value == 'false') ? false : true;
        if($sanitize){
            for($i = 0; $i < count($data); $i++){
                $data[$i]['value'] = htmlspecialchars($data[$i]['value']);
            }
        }
        return $data;
    }

    public function latest($key){
        $data = \App\Logger::where('key_1', '=', 'exceed_2018')
            ->where('key_2', '=', $key)
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

    public function latestValue($key){
        $data = \App\Logger::where('key_1', '=', 'exceed_2018')
            ->where('key_2', '=', $key)
            ->orderBy('created_at', 'desc')
            ->first();
        if($data == ''){
            $content = '';
        }
        else{
            $content = $data->value;
        }
        $sanitize = (\App\Preference::find('sanitize_results')->value == 'false') ? false : true;
        if($sanitize){
            $content = htmlspecialchars($content);
        }
        return response($content, 200)
                  ->header('Content-Type', 'text/plain');
    }

    public function set($key, Request $request){
        if(isset($request['value'])){
            $logger = new \App\Logger;
            $logger->key_1 = 'exceed_2018';
            $logger->key_2 = $key;
            $logger->value = $request['value'];
            $logger->save();
            $data = array(
                'status' => 'success'
            );
        }
        else{
            $data = array(
                'status' => 'failed',
                'error' => 'no value defined'
            );
        }
        return $data;
    }

    public function delete($key){
        $deleted = \App\Logger::where('key_1', '=', 'exceed_2018')
            ->where('key_2', '=', $key)
            ->delete();
        return $deleted;
    }
}
