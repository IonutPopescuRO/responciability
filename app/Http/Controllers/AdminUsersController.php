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
		
        Mail::raw('Text to e-mail', function ($m) use ($user) {
            $m->from('hello@app.com', 'Responciability');

            $m->to($user->email, $user->name)->subject('accepted!');
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


        Mail::raw('Text to e-mail', function ($m) use ($user) {
            $m->from('hello@app.com', 'Responciability');

            $m->to($user->email, $user->name)->subject('rejected!');
        });
		
        return Response::json([
                'code' => 200,
                'status' => 'banned',
            ], 200); 
    }
}
