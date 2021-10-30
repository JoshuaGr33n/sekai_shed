<?php

namespace App\Http\Controllers\ShedControllers;
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
use Auth;
use Session;
use DB;
use App\ShedModels\MenuData;
use App\ShedModels\OrdersModel;

class PageController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    
    

   

    
    
    
    public function shedDashboard(Request $request)
    {
        
       
        
        return View::make('shed.dashboard');
    }




    


    public function shedOrders(Request $request)
    {

          


        
        $orders = DB::select('select * FROM shed_orders ORDER BY created_at DESC');
       
        return view('shed.orders',['orders'=>$orders])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }








    public function shedTotalOrders(Request $request)
    {
       

      $totalOrders = DB::table('shed_orders')->count();
      $totalOrdersToday = DB::table('shed_orders')->whereDate('created_at', date('Y-m-d'))->count();
      $totalReservations = DB::table('shed_reservations')->count();
      $totalReservationsToday = DB::table('shed_reservations')->whereDate('created_at', date('Y-m-d'))->count();
      $totalNumberOfCustomers = DB::table('users')->count();
      $totalNumberOfCustomersToday = DB::table('users')->whereDate('created_at', date('Y-m-d'))->count();



      return view('shed.dashboard',['totalOrdersToday'=>$totalOrdersToday, 'totalReservationsToday'=>$totalReservationsToday, 'totalOrders'=>$totalOrders, 'totalReservations'=>$totalReservations,  'totalNumberOfCustomers'=>$totalNumberOfCustomers,  'totalNumberOfCustomersToday'=>$totalNumberOfCustomersToday]);
       
           
    }


  







    public function shedMenu(Request $request)
    {

     
        $menu = DB::select('select * FROM shed_menu ORDER BY created_at DESC');
        $menu_categories = DB::select('select * FROM shed_categories');
        return view('shed.menu',['menu'=>$menu,'menu_categories'=>$menu_categories])->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function shedReservations(Request $request)
    {

    
        $reservation = DB::select('select * FROM shed_reservations ORDER BY created_at DESC');
        return view('shed.reservations',['reservation'=>$reservation])
        ->with('i', (request()->input('page', 1) - 1) * 5);

  
       
    }

    public function shedCategories(Request $request)
    {

      
        $categories = DB::select('select * FROM shed_categories ORDER BY created_at DESC');
        return view('shed.categories',['categories'=>$categories])
        ->with('i', (request()->input('page', 1) - 1) * 5);

    
    }



}
