<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Session;
class AuthCtrl extends Controller
{
    //

    public function __construct(){
    	

    }
    public function login(Request $request){
        $data = [];
        if(!empty(session('user_login'))){ return redirect('/'); }
        return view('auth.login')->with($data);
    }

    public function register(Request $request){
        $data = [];
        if(!empty(session('user_login'))){ return redirect('/'); }
        return view('auth.register')->with($data);
    }

    public function do_register(Request $request){

    	$rules = [
            'f_name' => 'required|min:2|max:255',
            'l_name' => 'required|min:2|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'password' => 'required_with:conf_password|min:8|same:conf_password',
            'conf_password' => 'min:8'
        ];

        $customMessages = [
            'f_name.required' => 'First Name is empty',
            'f_name.min' => 'First Name is too short',
            'f_name.max' => 'First Name is too long',
            'l_name.required' => 'Last Name is empty',
            'l_name.min' => 'Last Name is too short',
            'l_name.max' => 'Last Name is too long',
            'email.required' => 'Email is empty',
            'email.email' => 'Email is not valid',
            'email.unique' => 'This email is already registered with us',
            'mobile.required' => 'Phone is empty',
            'password.required_with' => 'Password is empty',
            'password.min' => 'Password must be 8 digit long',
            'password.same' => 'Password & Confirm password must be same',
            'conf_password.required' => 'Confirm password is required',
        ];
        $validator = $this->validate($request, $rules, $customMessages);

        if (!is_array($validator) && $validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }else{

        	$formData = $request->all();
        	

        	$insert = [
        		'f_name' => $formData['f_name'],
			    'l_name' => $formData['l_name'],
			    'email' => $formData['email'],
			    'mobile' => $formData['mobile'],
			    'password' => md5($formData['password'])	
        	];

            $user = User::create($insert);
            session(['user_login' => $user->id]);
            return redirect('/');
        }
    }

    public function do_login(Request $request){



    	$rules = [
            'email' => 'required|email', 
            'password' => 'required|min:8',
        ];

        $customMessages = [
            'email.required' => 'Email is empty',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is empty',
            'password.min' => 'Password must be 8 digit long',
        ];
        $validator = $this->validate($request, $rules, $customMessages);

        if (!is_array($validator) && $validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }else{

        	$formData = $request->all();
		    $email = $formData['email'];
		    $password = md5($formData['password']);

		    $isEmailRegistered = User::where('email',$email)->count();
		    if($isEmailRegistered <= 0){
 				Session::flash('error', 'This email is not registered with us.');
 				return redirect()->back()->withInput();
		    }else{
		    	$isPasswordCorrect = User::where('email',$email)->where('password',$password)->count();
		    	if($isPasswordCorrect <= 0){
					Session::flash('error', 'Email/Password is/are not correct.');
					return redirect()->back()->withInput();
		    	}else{
		    		// logged in
		    		$user = User::select('id')->where('email',$email)->where('password',$password)->first();
		    		$user_id = $user['id'];
		    		session(['user_login' => $user_id]);
					return redirect('/');
		    	}
		    }
			
        }
    }

    public function logout(){
    	session()->forget('user_login');
    	return redirect('/');
    }

}
