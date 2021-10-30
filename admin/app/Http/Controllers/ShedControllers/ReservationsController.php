<?php

namespace App\Http\Controllers\ShedControllers;
use App\Http\Controllers\Controller;


use App\ShedModels\ReservationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;




class ReservationsController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservationsModel  $Reservations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

       

              
        ReservationsModel::find($id)->delete();
  
        return Redirect::to('shedReservations')
                        ->with('delete_success','Record deleted successfully');
    }
}