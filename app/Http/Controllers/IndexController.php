<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use App\User;
use DB;
use Auth;

class IndexController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $issues = Issue::where(['status' => 2])->get(); // get only active issues
        $solvedIssues= Issue::where('status', 3)->get();
        $users = User::all();

        $upvotes = $downvotes = 0;

        foreach($issues as $issue){
            $upvotes+=count($issue->upvotes());
            $downvotes+=count($issue->downvotes());
        }

        $user_area = DB::table('user_area')
                             ->select('lat', 'lng')
                             ->get();
		
        return view('welcome',[
            'issues' => $issues,
            'user_area' => $user_area,
            'upvotes' => $upvotes,
            'downvotes' => $downvotes,
            'solvedIssues' => $solvedIssues,
            'users' => $users,
        ]);
    }
}
