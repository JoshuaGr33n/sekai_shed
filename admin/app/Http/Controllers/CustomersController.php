<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;


use App\CustomersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;




class CustomersController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomersModel  $Reservations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        

              
        CustomersModel::find($id)->delete();
  
        return Redirect::to('customers')
                        ->with('delete_success','Record deleted successfully');
    }
}