<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferencesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function preferences()
    {
        $preferences = \App\Preference::all();
        return view('preferences')->with('preferences', $preferences);
    }

    public function save(Request $request)
    {
        foreach($_POST as $key => $value){
            if($key != '_token'){
                $p = \App\Preference::find($key);
                if($p) {
                    $p->value = $value;
                    $p->save();
                }
            }
        }
        return redirect('preferences');
    }
}
