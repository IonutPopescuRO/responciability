<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;

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
	
    public function admin($userId = null, Request $request)
    {
		if(Auth::user()->role!=2 || !User::where('id',  $userId)->count())
			return redirect()->route('home');

		$user_area = DB::table('user_area')
							 ->select('lat', 'lng')
							 ->where('user_id', '=', $userId)
							 ->get();
							 
		$user = User::findOrFail($userId);
		
		
		$user->role = $request->input('role');
		$user->save();

        return view('admin/profile', ['user_area' => $user_area, 'user_id' => $userId, 'user' => $user]);
    }
}
