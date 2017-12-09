<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use DB;
use Auth;

class IndexController extends Controller
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

        $upvotes = $downvotes = 0;

        foreach($issues as $issue){
            $upvotes+=count($issue->upvotes());
            $downvotes+=count($issue->downvotes());
        }

        $user_area = DB::table('user_area')
                             ->select('lat', 'lng')
                             ->where('user_id', '=', Auth::user()->id)
                             ->get();
		
        return view('welcome',[
            'issues' => $issues,
            'user_area' => $user_area,
            'upvotes' => $upvotes,
            'downvotes' => $downvotes
        ]);
    }
}
