<?php 

namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use App\Contact; 
use Mail; 

class ContactController extends Controller { 

     

     public function saveContact(Request $request) { 
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

      

        \Mail::send('message',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'subject' => $request->get('subject'),
                 'phone_number' => $request->get('phone_number'),
                 'user_message' => $request->get('message'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);
                  $message->to('codingdriver15@gmail.com');
               });

          return back()->with('success', 'Thank you for contacting us!');

    }
}