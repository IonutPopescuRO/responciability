<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Response;
use Mail;

class AdminUsersController extends Controller
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
		if(Auth::user()->role!=2)
			return redirect()->route('home');
		
		$users = User::paginate(20);

        return view('admin/users', ['users' => $users]);
    }

    public function approve(Request $request)
    {
        $input = $request->all();

        $id = $input['uid'];

        $user = User::find($id);

        $user->accepted = 1;
        $user->save();
		
        Mail::raw('Hello! And welcome to Responciability. We hope you will have a good time and make your community grow together. Good luck submitting issues!', function ($m) use ($user) {
            $m->from('contact@responciability.com', 'Responciability');

            $m->to($user->email, $user->name)->subject('Welcome to Responciability!');
        });

        return Response::json([
                'code' => 200,
                'status' => 'approved',
            ], 200); 
    }

    public function ban(Request $request)
    {
        $input = $request->all();

        $id = $input['uid'];

        $user = User::find($id);

        $user->accepted = 0;
        $user->save();


        Mail::raw('We\'re sorry, but our admins decided that you are not a good fit for a platform like Reponciability. Please try registering later!', function ($m) use ($user) {
            $m->from('contact@responciability.com', 'Responciability');

            $m->to($user->email, $user->name)->subject('We\'re sorry...');
        });
		
        return Response::json([
                'code' => 200,
                'status' => 'banned',
            ], 200); 
    }
}
