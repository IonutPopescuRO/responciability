<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Issue;
use App\User;
use App\Vote;
use Illuminate\Support\Carbon;

class AdminIssuesController extends Controller
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

    
    public function index()
    {
		if(Auth::user()->role!=2)
			return redirect()->route('home');
		
		$issue = Issue::paginate(20);

        return view('admin/issues', ['issues' => $issue]);
    }

    public function stats()
    {   
        $archivedIssues=Issue::where('status', 1)->get();
        $solvedIssues= Issue::where('status', 3)->get();
        $users = User::all();
        $issues= Issue::all();
        $votes = Vote::all();
        $ttsr = number_format((float) count($solvedIssues)/count($issues), 2, '.', '');
        $lpu= number_format((float) count($votes)/count($users), 2, '.', '');
        $lastmonth = User::where('created_at', '>=', Carbon::now()->subMonth())->get();
        
        return view('admin/stats',
            [
                'archivedIssues' => $archivedIssues,
                'solvedIssues' => $solvedIssues,
                'users' => $users,
                'issues' => $issues,
                'ttsr' => $ttsr,
                'votes' => $votes,
                'lpu' => $lpu,
                'lastmonth' => $lastmonth
        ]);
    }
}
