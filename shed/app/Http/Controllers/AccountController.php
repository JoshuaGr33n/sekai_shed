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
use App\AccountModel;
use Illuminate\Support\Facades\Hash;
use Redirect;
use View;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller { 

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    




     public function createAccount(Request $request) { 
        $this->validate($request, [
            'customer_fname' => 'required',
            'customer_lname' => 'required',
            'gender' => 'required',
            'customer_phone' => 'required',
            'email' => 'required|email|required_with:retype_email',
            'retype_email' => 'required|same:email',
            'password' => 'min:6|required_with:retype_password',
            'retype_password' => 'min:6|required|same:password'
            
        ]);

        $create_acct = new AccountModel;

        
        $check_email =  DB::select("select * FROM users WHERE email='$request->email'");
        $check_phone=  DB::select("select * FROM users WHERE phone='$request->customer_phone'");
        if ($check_email) {
         return back()->with('email_duplicate_error', 'Email already belong to another User!');
        }
        if ($check_phone) {
         return back()->with('phone_duplicate_error', 'Phone Number already belong to another User!');
        }

        $create_acct->fname = $request->customer_fname;
        $create_acct->lname = $request->customer_lname;
        $create_acct->gender = $request->gender;
        $create_acct->phone = $request->customer_phone;
        $create_acct->email = $request->email;
        $create_acct->password = \Hash::make($request->password);
        
         

        $create_acct->save();

       

          return back()->with('success', 'Registration Successful!');
       

    }
    public function showEditProfilePage()
    {
      if (!Auth::check()) {
        return Redirect::to('/');
        }
  
        return View::make('edit-my-profile');

          }


    public function updateAccount(Request $request) { 
      if (!Auth::check()) {
        return Redirect::to('/');
    }
    $update_acct = AccountModel::find(Auth::id());
      $this->validate($request, [
          'customer_fname' => 'required',
          'customer_lname' => 'required',
          'gender' => 'required',
          'customer_phone' => 'required',
          'email' => 'required|email|required_with:retype_email',
          'retype_email' => 'required|same:email'
          
      ]);
      $id=Auth::id();

            $check_email =  DB::select("select * FROM users WHERE email='$request->email' AND id NOT IN('$id')");
            $check_phone=  DB::select("select * FROM users WHERE phone='$request->customer_phone' AND id NOT IN('$id')");
             if ($check_email) {
              return back()->with('email_duplicate_error', 'Email already belong to another User!');
             }
             if ($check_phone) {
              return back()->with('phone_duplicate_error', 'Phone Number already belong to another User!');
             }

      $update_acct->fname = $request->customer_fname;
      $update_acct->lname = $request->customer_lname;
      $update_acct->gender = $request->gender;
      $update_acct->phone = $request->customer_phone;
      $update_acct->email = $request->email;
 
      $update_acct->save();

     
      $update_acct->update($request->all());

        return back()->with('success', 'Profile Updated!');
     

  }





    public function updateAddress(Request $request) { 
       if (!Auth::check()) {
            return Redirect::to('/');
        }
      $updateAddress = AccountModel::find(Auth::id());
      $this->validate($request,[
        'address' => 'required',
       
     ]);
     
            $updateAddress->address = request('address');
            $updateAddress->save();
      
            $updateAddress->update($request->all());
   
            return back()->with('success', 'Address Updated');
     

  }






  public function changePassword(Request $request) { 
    if (!Auth::check()) {
         return Redirect::to('/');
     }
     $rules = array(
      'old_password'    => 'min:6|required', 
      'new_password' => 'min:6|required_with:confirm_new_password',
      'confirm_new_password' => 'min:6|required|same:new_password' 
    );
  
    
    $validator = Validator::make(Input::all(), $rules);
  
  
    if ($validator->fails()) {
      return Redirect::to('edit-my-profile')
          ->withErrors($validator); 
    } else {
  
      
      $userdata = array(
          'email'     => Auth::user()->email,
          'password'  => Input::get('old_password')
      );
     
      if (Auth::attempt($userdata)) {
              $changePassword = AccountModel::find(Auth::id());
              $changePassword->password = \Hash::make(request('new_password'));
              $changePassword->save();
        
              $changePassword->update($request->all());
     
              return back()->with('password_success', 'Password Changed');
  
      } else {        
  
        
             return back()->with('incorrect_password', 'Old Password Incorrect');
  
      }
  
  }
  

}



    public function customerProfile()
    {
       
  
        return View::make('customer-profile');

      }




    public function myOrders()
    {
      if (!Auth::check()) {
        return Redirect::to('/');
    }
    
      $customer_id=Auth::id();
      $myOrders = DB::select("select * FROM shed_orders WHERE customer_id ='$customer_id' ORDER BY created_at DESC");
       
      return view('my-orders',['myOrders'=>$myOrders])
      ->with('i', (request()->input('page', 1) - 1) * 5);
      
  
    }
  

    
}