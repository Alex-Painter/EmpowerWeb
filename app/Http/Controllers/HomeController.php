<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

  protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function doLogin(Request $request){

      $credentials = array(
        'name' => $request->input('username'),
        'password' => $request->input('password')
      );

      if (Auth::attempt($credentials)){
        return redirect('/issues');
      }else{
        return redirect('/')->with('message', 'Incorrect login, please try again.');
      }
    }

    public function doLogout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
