<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;
use Auth;
class ProfileController extends Controller
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
		$user_id = Auth::user()->id;
		$user_area = DB::table('user_area')
							 ->select('lat', 'lng')
							 ->where('user_id', '=', $user_id)
							 ->get();
							 
        return view('profile', ['user_area' => $user_area]);
    }
}
