<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\AuthAccessAuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Http\Request;

use app\Admin;
use View;
use Input;
use Redirect;
use Illuminate\Support\Facades\Auth;
use DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    
    

    


    public function adminLandingPage(Request $request)
    {
        if(Auth()->check()){
        
        // admin landing page
        return View::make('admin_landing');

        }
        return Redirect::to('admin');
    }






    public function showAdmin()
    {
       
        if (Auth::check()) {
            return Redirect::to('sekaiDashboard');
        }
        
        // show the form
        return View::make('admin');

        // Session::flush();
    }
    






    public function doLogin()
    {
    // process the form
    // validate the info, create rules for the inputs
 $rules = array(
    'email'    => 'required|email', // make sure the email is an actual email
    'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
  );

  // run the validation rules on the inputs from the form
  $validator = Validator::make(Input::all(), $rules);

  // if the validator fails, redirect back to the form
  if ($validator->fails()) {
    return Redirect::to('admin')
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
  } else {

    // create our user data for the authentication
    $userdata = array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password')
    );

    // attempt to do the login
    if (Auth::attempt($userdata)) {

        

        $user = Auth::user();
       
        // Session::put('email', $user->email);
        // Session::put('fname', $user->fname);
        // Session::put('lname', $user->lname);

        
        // $userInfo = Admin::find(Auth::id());
        // return View::make('admin_landing')->with('userInfo',$userInfo);
        
        return redirect()->intended('landing_page');
        
        // return Redirect::to('landing_page');
       

        

    } else {        

        // validation not successful, send back to form 
        return Redirect::to('admin')->with('login_error','Login Details Incorrect');

    }

}
    }



   


   


    public function doLogout()
{
    Auth::logout(); // log the user out of our application
    // Session::flush();
    return Redirect::to('admin'); // redirect the user to the login screen
    
}





public function customers(Request $request)
    {
        $customers = DB::select('select * FROM users ORDER BY created_at DESC');
        return view('customers',['customers'=>$customers])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
 
    
}
