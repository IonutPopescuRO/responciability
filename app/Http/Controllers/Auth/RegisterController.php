<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\AreaOfInterest;
use Mapper;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{   
    private $avatar;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {   
        Mapper::map(53.381128999999990000, -1.470085000000040000);

        return view('auth.register');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'lname' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required',
            'avatar' => 'image',
            'location' => 'required',
            'area' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $v = explode(';' , $data['location']);

        $ulat = $v[0];
        $ulng = $v[1];

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'age' => $data['age'],
            'gender' => $data['gender'],
            'lname' => $data['lname'],
            'avatar' => NULL,
            'lat' => $ulat,
            'lng' => $ulng
        ]);

        foreach($data['area'] as $vertice)
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

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($request->hasFile('avatar')) {
            $this->avatar = $request->file('avatar');
        }

        if($request->hasFile('avatar')) {
                $avatarName = 'p_' .$user->id . '.' . $this->avatar->getClientOriginalExtension();
                $this->avatar->move('users/'.$user->id , $avatarName);
                $user->avatar = '../users/'.$user->id.'/' . $avatarName;
                $user->save();
        }

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
