<?php

namespace App\Http\Controllers\SekaiControllers;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\AuthAccessAuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;



use View;
use Input;
use Redirect;
use Illuminate\Support\Facades\Auth;

use DB;
use App\SekaiModels\MenuData;
use App\SekaiModels\OrdersModel;

class PageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    
    


    
    
    public function sekaiDashboard(Request $request)
    {
        
     
          return View::make('sekai.dashboard');
             
       
    }




    


    public function sekaiOrders(Request $request)
    {

        $orders = DB::select('select * FROM sekai_orders ORDER BY created_at DESC');
       
        return view('sekai.orders',['orders'=>$orders])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }








    public function sekaiTotalOrders(Request $request)
    {
       


        $totalOrders = DB::table('sekai_orders')->count();
        $totalOrdersToday = DB::table('sekai_orders')->whereDate('created_at', date('Y-m-d'))->count();
        $totalReservations = DB::table('sekai_reservations')->count();
        $totalReservationsToday = DB::table('sekai_reservations')->whereDate('created_at', date('Y-m-d'))->count();
        $totalNumberOfCustomers = DB::table('users')->count();
        $totalNumberOfCustomersToday = DB::table('users')->whereDate('created_at', date('Y-m-d'))->count();


  
        return view('sekai.dashboard',['totalOrdersToday'=>$totalOrdersToday, 'totalReservationsToday'=>$totalReservationsToday, 'totalOrders'=>$totalOrders, 'totalReservations'=>$totalReservations,  'totalNumberOfCustomers'=>$totalNumberOfCustomers,  'totalNumberOfCustomersToday'=>$totalNumberOfCustomersToday]);
       
           
    }


  







    public function sekaiMenu(Request $request)
    {

        $menu = DB::select('select * FROM sekai_menu ORDER BY created_at DESC');
        $menu_categories = DB::select('select * FROM sekai_categories');

        return view('sekai.menu',['menu'=>$menu,'menu_categories'=>$menu_categories])->with('i', (request()->input('page', 1) - 1) * 5);
     
    }

   

    public function sekaiReservations(Request $request)
    {

        $reservation = DB::select('select * FROM sekai_reservations ORDER BY created_at DESC');
        return view('sekai.reservations',['reservation'=>$reservation])
        ->with('i', (request()->input('page', 1) - 1) * 5);

       
    }




    public function sekaiCategories(Request $request)
    {

      
        $categories = DB::select('select * FROM sekai_categories ORDER BY created_at DESC');
        return view('sekai.categories',['categories'=>$categories])
        ->with('i', (request()->input('page', 1) - 1) * 5);

    
    }


}
