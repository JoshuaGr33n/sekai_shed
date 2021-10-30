<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



 //FRONT SECTION START
 Route::get('/', function () {

   if (Auth::check()) {
      return Redirect::to('sekaiDashboard');
  }

    return view('admin');

   
 });








 
 // route to show the login form
 Route::get('admin', array('uses' => 'Controller@showAdmin'));

 // route to process the form
 Route::post('admin', array('uses' => 'Controller@doLogin'));

  //logout route
   Route::get('landing_page', array('uses' => 'Controller@adminLandingPage'));

 // route to customers
 Route::get('customers', array('uses' => 'Controller@customers'));
 // route to customers
 Route::resource('customers_data','CustomersController');

 //logout route
 Route::get('logout', array('uses' => 'Controller@doLogout'));





 //Sekai SECTION START
 
 
 // route to dashboard
  Route::get('sekaiDashboard', array('uses' => 'SekaiControllers\PageController@sekaiDashboard'));
  

  Route::get('sekaiDashboard', array('uses' => 'SekaiControllers\PageController@sekaiTotalOrders'));

  

 

 // route to orders
 Route::get('sekaiOrders', array('uses' => 'SekaiControllers\PageController@sekaiOrders'));


 // route to order data
 Route::resource('sekai_order_data','SekaiControllers\OrdersController');




 // route to menu
 Route::get('sekaiMenu', array('uses' => 'SekaiControllers\PageController@sekaiMenu'));

 // route to menu data
 Route::resource('sekai_menu_data','SekaiControllers\MenuDataController');

 Route::get('/sekai_menu_data/{id}/updateMenuStatus', 'SekaiControllers\MenuDataController@updateMenuStatus')->name('sekai_menu_data.updateMenuStatus');
 
 Route::get('/sekai_menu_data/{id}/item_order_history', 'SekaiControllers\MenuDataController@itemOrderHistory')->name('sekai_menu_data.itemOrderHistory');

 Route::delete('/sekai_menu_data/{id}/delete_item_order', 'SekaiControllers\MenuDataController@deleteItemOrder')->name('sekai_menu_data.deleteItemOrder');

 Route::get('/sekai_menu_data/{id}/back', 'SekaiControllers\MenuDataController@backItemOrderHistory')->name('sekai_menu_data.backItemOrderHistory');

 //transfer menu table values to order history page
 Route::get('/sekai_menu_data/{id}/viewMenuItemInfo', 'SekaiControllers\MenuDataController@viewMenuItemInfo')->name('sekai_menu_data.viewMenuItemInfo');
 

 

 // route to reservations
 Route::get('sekaiReservations', array('uses' => 'SekaiControllers\PageController@sekaiReservations'));


 // route to reservations data
 Route::resource('sekai_reservation_data','SekaiControllers\ReservationsController');



////////////////

 // route to categories
 Route::get('sekaiCategories', array('uses' => 'SekaiControllers\PageController@sekaiCategories'));
 Route::post('sekai_store_category', 'SekaiControllers\CategoriesController@sekaiStoreCategory');

 // route to categories data
 Route::resource('sekai_categories_data','SekaiControllers\CategoriesController');

 //Sekai SECTION END
 

 





 
 //Shed SECTION START
 
 
 // route to dashboard
 Route::get('shedDashboard', array('uses' => 'ShedControllers\PageController@shedDashboard'));
 Route::get('shedDashboard', array('uses' => 'ShedControllers\PageController@shedTotalOrders'));

 



 // route to orders
 Route::get('shedOrders', array('uses' => 'ShedControllers\PageController@shedOrders'));


 // route to order data
 Route::resource('shed_order_data','ShedControllers\OrdersController');




 // route to menu
 Route::get('shedMenu', array('uses' => 'ShedControllers\PageController@shedMenu'));

 // route to menu data
 Route::resource('shed_menu_data','ShedControllers\MenuDataController');

 Route::get('/shed_menu_data/{id}/updateMenuStatus', 'ShedControllers\MenuDataController@updateMenuStatus')->name('shed_menu_data.updateMenuStatus');

 Route::get('/shed_menu_data/{id}/item_order_history', 'ShedControllers\MenuDataController@itemOrderHistory')->name('shed_menu_data.itemOrderHistory');

 Route::delete('/shed_menu_data/{id}/delete_item_order', 'ShedControllers\MenuDataController@deleteItemOrder')->name('shed_menu_data.deleteItemOrder');

 Route::get('/shed_menu_data/{id}/back', 'ShedControllers\MenuDataController@backItemOrderHistory')->name('shed_menu_data.backItemOrderHistory');

 //transfer menu table values to order history page
 Route::get('/shed_menu_data/{id}/viewMenuItemInfo', 'ShedControllers\MenuDataController@viewMenuItemInfo')->name('shed_menu_data.viewMenuItemInfo');


 


 




 // route to reservations
 Route::get('shedReservations', array('uses' => 'ShedControllers\PageController@shedReservations'));


 // route to reservations data
 Route::resource('shed_reservation_data','ShedControllers\ReservationsController');




  // route to categories
  Route::get('shedCategories', array('uses' => 'ShedControllers\PageController@shedCategories'));
  Route::post('shed_store_category', 'ShedControllers\CategoriesController@shedStoreCategory');
 
  // route to categories data
  Route::resource('shed_categories_data','ShedControllers\CategoriesController');
 
 //Shed SECTION END





 
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');





