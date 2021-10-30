<?php

namespace App\Http\Controllers\SekaiControllers;
use App\Http\Controllers\Controller;


use App\SekaiModels\OrdersModel;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;


class OrdersController extends Controller
{
   

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdersModel  $Orders
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
         




           // check if url Id exist
           $check = OrdersModel::where('id', $id)->first();
           if (!$check) {
             return Redirect::to('sekaiOrders');
                 }

                
             

        $Orders = OrdersModel::find($id);
        return view('sekai.view_order',compact('Orders'));
            
    
    }

   









    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdersModel  $Orders
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {


        $Orders = OrdersModel::find($id);
        $Orders->delivery_status = request('delivery');
        $Orders->payment_status = request('payment');
        $Orders->save();
        $this->validate($request,[
            
            'delivery' => 'required',
            'payment' => 'required',
         
         ]);
        $Orders->update($request->all());
  
        return Redirect::to('sekai_order_data/'.$id)
                        ->with('success','Item updated successfully');
    }








    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdersModel  $Orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

       

        OrdersModel::find($id)->delete();
  
        return Redirect::to('sekaiOrders')
                        ->with('delete_success','Record deleted successfully');
    }
}