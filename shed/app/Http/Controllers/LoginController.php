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
use Illuminate\Support\Facades\Hash;


use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller { 

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    public function login()
    {
  
 $rules = array(
    'email'    => 'required|email', 
    'password' => 'required|alphaNum|min:3' 
  );

  
  $validator = Validator::make(Input::all(), $rules);


  if ($validator->fails()) {
    return Redirect::to('account')
        ->withErrors($validator) 
        ->withInput(Input::except('password')); 
  } else {

    
    $userdata = array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password')
    );
   
    // attempt to do the login
    if (Auth::attempt($userdata)) {

        

        $user = Auth::user();
       
        if(session('cart')){
            return redirect()->intended('/cart');
        }
        
        return redirect()->intended('/');
        
       
       

        

    } else {        

      
        return Redirect::to('account')->with('login_error','Login Details Incorrect');

    }

}
    }


    public function doLogout()
    {
        Auth::logout(); 
        return Redirect::to('account');
        
    }

}
