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
use Session;

use App\MenuModel;
use View;
use Input;
use Redirect;
use Auth;
use App\OrdersModel;
use DB;

class CartController extends Controller
{
    

    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product =  MenuModel::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "pic" => $product->pic
                ]
            ];

            session()->put('cart', $cart);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Item added to cart!', 'data' => $htmlCart]);

            //return redirect()->back()->with('success', 'Item added to cart!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Item added to cart!', 'data' => $htmlCart]);

            //return redirect()->back()->with('success', 'Item added to cart!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "pic" => $product->pic
        ];

        session()->put('cart', $cart);

        $htmlCart = view('_header_cart')->render();

        return response()->json(['msg' => 'Item added to cart!', 'data' => $htmlCart]);

        //return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            $subTotal = $cart[$request->id]['quantity'] * $cart[$request->id]['price'];

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Cart updated successfully', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal]);

            //session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            $total = $this->getCartTotal();

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Item removed successfully', 'data' => $htmlCart, 'total' => $total]);

            //session()->flash('success', 'Product removed successfully');
        }
    }


    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }




    public function redirectToDeliveryPay(Request $request)
    {
       
        

        if ($request->input('payment_method')=="Pay on Delivery") {
            return Redirect::to('pay-on-delivery');
        }
        elseif ($request->input('payment_method')=="Online Payment") {
            return Redirect::to('pay-online');
        }

        return Redirect::to('cart');
    
    }


    public function DeliveryPay(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->intended('account')->with('login_alert', 'You need to Login or SignUp to continue with your purchase');
        }
            return view('pay-on-delivery-process');
        
      
    }

   
    public function OnlinePay(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->intended('/account')->with('login_alert', 'You need to Login or SignUp to continue with your purchase');
        }
            return view('pay-online-process');
        
      
    }


    



    public function submitOrder(Request $request) { 
      
        if(empty($request->input('item_id'))){
            return Redirect::to('shop');
        }

          $this->validate($request,[
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
           
      ]);
        $unique = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);

        $check = OrdersModel::where('order_id', $unique)->first();
        
        $count = count($request->input('item_id'));
        if(empty($request->input('note'))){

            $request->input('note', '');
        }
        
        for($i=0; $i < $count; $i++){
        $order = new OrdersModel;
        $order->order = $request->item_name[$i];
        $order->item_id = $request->item_id[$i];
        $order->order_id = $unique;
        $order->customerFname = Auth::user()->fname;
        $order->customerLname = Auth::user()->lname;
        $order->customer_id = Auth::id();
        $order->quantity =$request->quantity[$i];
        $order->price =$request->price[$i];
        $order->pic =$request->pic[$i];
        $order->payment_status =$request->input('payment_status');
        $order->payment_method =$request->input('payment_method');
        $order->address =$request->input('address');
        $order->email =$request->input('email');
        $order->phone =$request->input('phone');
        $order->note =$request->input('note');
        if (!$check) {
        $order->save();
       
        }
      }

      Session::forget('cart');

        return Redirect::to('cart')->with('delivery_success','Order Placement Sucessful.');
        

    }

    public function clearCart(Request $request)
    {

        Session::forget('cart');

        return Redirect::to('cart');
        
      
    }



}