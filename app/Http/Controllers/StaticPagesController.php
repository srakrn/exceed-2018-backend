<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    function api_docs(){
        return view('api_docs');
    }
    function db_stats(){
        $last_record = \App\Logger::orderBy('created_at', 'desc')->first();
        return view('db_stats', compact('last_record'));
    }
}
