<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\AreaOfInterest;
use Mail;

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
							 
		$user = User::findOrFail($userId);
		
		$user->role = $request->input('role');
		$user->save();

        return back();
    }
	
    public function updateProfile(Request $request)
    {
		$user = Auth::user();

		$v = explode(';' , $request['location']);
        $ulat = $v[0];
        $ulng = $v[1];

		$user->name = $request->input('name');
		$user->lname = $request->input('lname');
		$user->age = $request->input('age');
		$user->gender = $request->input('gender');
		
		if($user->lat!==$ulat || $user->lng!==$ulng)
		{
			$user->lat = $ulat;
			$user->lng = $ulng;
		}
		
		$user->save();
		
		AreaOfInterest::where(array('user_id' => $user->id))->delete();
		
        foreach($request['area'] as $vertice)
        {
            $v = explode(';', $vertice);
            $lat = $v[0];
            $lng = $v[1];

            AreaOfInterest::create([
                'lat' => $lat,
                'lng' => $lng,
                'user_id' => $user->id,
            ]);
        }

        return back();
    }

    public function viewAsAdmin($userId)
    {   

        if(Auth::user()->role!=2 || !User::where('id',  $userId)->count())
            return redirect()->route('home');

        $user_area = DB::table('user_area')
                             ->select('lat', 'lng')
                             ->where('user_id', '=', $userId)
                             ->get();
                             
        $user = User::findOrFail($userId);

        return view('admin/profile', ['user_area' => $user_area, 'user_id' => $userId, 'user' => $user]);
    }
}
