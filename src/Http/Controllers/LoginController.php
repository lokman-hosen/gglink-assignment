<?php

namespace Gglink\CrudPermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Gglink\CrudPermission\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $service;
    public $userType;
    const moduleDirectory = 'crudPermission::auth.';


    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService){
        // if user login is success then check user token exist with this middleware.
        //for now i keep it off because i can not login with the end point
        //$this->middleware('checkUserAuthenticate')->only(logout);
        $this->service = $loginService;
    }

    // login form
    public function loginForm(){
        return view(self::moduleDirectory.'index');
    }

    // login here and store user unique token to session for next use
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect(route('users.login.form'))
                ->withErrors($validator)
                ->withInput();
        }

        $response = $this->service->userLogin($request);
        if ($response->successful()){
            // store the user unique token
            session(['token' => $request->token]);
            $request->session()->flash('success', 'Login Success');
            return redirect()->route('users.index');
        }elseif ($response->serverError()){
            $request->session()->flash('error', 'Server Error');
        }else{
            $request->session()->flash('error', 'Something went wrong ');
        }
        return redirect()->route('users.login.form');
    }

    public function logout(Request $request){
        $response = $this->service->userLogout($request->user_id);
        if ($response->successful()){
            $request->session()->flash('success', 'Logout Success');
            return redirect()->route('users.login.form');
        }elseif ($response->serverError()){
            $request->session()->flash('error', 'Server Error');
        }else{
            $request->session()->flash('error', 'Something went wrong ');
        }
        return redirect()->route('users.index');
    }
}
