<?php

namespace App\Http\Controllers;


use App\ReservationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Storage;
use DB;



class ReservationsController extends Controller
{
   








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

       
        

          $this->validate($request,[
            'fname' => 'required',
            'date' => 'required',
            'time' => 'required',
            'guests' => 'required',
            'phone' => 'required',

            
            
         ]);

        
         ReservationsModel::create($request->all());
         
        
        


        return Redirect::to('reservation')
                        ->with('success','Reservation Booked');
    }


}