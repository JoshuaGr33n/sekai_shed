<?php

namespace App\Http\Controllers;


use App\MenuModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\AuthAccessAuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Http\Request;

use View;
use Input;
use Redirect;
use Auth;

use DB;



class MenuController extends Controller
{
   
   





    
   


    public function show($id, Request $request)
    {
         

            // check if url Id exist
             $check = MenuModel::where('id', $id)->where('item_status', '=', 'Available')->first();
             if (!$check) {
              return Redirect::to('menu');
                }
                $categories =  DB::select('SELECT * FROM shed_categories');
        $itemData = MenuModel::find($id);
        $newArrivals=  MenuModel::orderBy('created_at', 'DESC')->where('item_status', '=', 'Available')->paginate(5);

      
        
        $count_category = MenuModel::all()->where('item_status', '=', 'Available')->count();

         if($count_category>=6){

            $category = MenuModel::all()->where('item_status', '=', 'Available')->random(6);
         }
         else{
           $category = MenuModel::all()->where('item_status', '=', 'Available')->random($count_category);
         }

        return view('food_detail',['newArrivals'=>$newArrivals, 'itemData'=>$itemData, 'category'=>$category,'categories'=>$categories]);
       
        

    }


   




   

   

    
   


}