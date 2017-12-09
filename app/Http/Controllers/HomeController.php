<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use DB;
use Auth;

class HomeController extends Controller
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
    public function index()
    {   
        $issues = Issue::where(['status' => 2])->get(); // get only active issues
        
        $user_area = DB::table('user_area')
                             ->select('lat', 'lng')
                             ->where('user_id', '=', Auth::user()->id)
                             ->get();
        return view('home',[
            'issues' => $issues,
            'user_area' => $user_area
        ]);
    }
}
