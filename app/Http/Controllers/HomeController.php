<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use App\Vote;
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
        $issues = Issue::whereIn('status' , [2,3])->get(); // get only active issues

        $solved = Issue::where(['user_id' => Auth::user()->id, 'status' => 3])->get();

        $upvotes = Vote::where(['user_id' => Auth::user()->id, 'type' =>1])->get();

        $downvotes = Vote::where(['user_id' => Auth::user()->id, 'type' =>0])->get();

        $user_area = DB::table('user_area')
                             ->select('lat', 'lng')
                             ->where('user_id', '=', Auth::user()->id)
                             ->get();
        return view('home',[
            'issues' => $issues,
            'user_area' => $user_area,
            'upvotes' => count($upvotes),
            'downvotes' => count($downvotes),
            'solved' => $solved
        ]);
    }
}
