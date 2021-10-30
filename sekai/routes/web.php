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


Route::get('recipe', function () {
    return view('recipe');
  });
  Route::get('404', function () {
    return view('404');
  });
 
  Route::get('food_detail', function () {
    return view('food_detail');
  });
 
 
 
 
 
 
 
   // route to home
   Route::get('/', array('uses' => 'Controller@home'));
 
   // route to menu
   Route::get('menu', array('uses' => 'Controller@menu'));
 
   // route to reservation
   Route::get('reservation', array('uses' => 'Controller@reservation'));
 
   // route to about us
   Route::get('about', array('uses' => 'Controller@about'));
 
   // route to gallery
   Route::get('gallery', array('uses' => 'Controller@gallery'));
 
   //route to shop
   Route::get('shop', array('uses' => 'Controller@shop'));
  
   
 //route to menu category
 Route::get('/menu-category/{category}', 'Controller@menuCategory')->name('menu-category');
 




   // route to contact
   Route::get('contact', array('uses' => 'Controller@contact'));

   // route to send email
   Route::post('contact-send', array('uses' => 'ContactController@saveContact'));



 

  Route::get('cart', 'CartController@cart');

  Route::get('add-to-cart/{id}', 'CartController@addToCart');

  Route::patch('update-cart', 'CartController@update');

 Route::delete('remove-from-cart', 'CartController@remove');


 Route::post('payment', 'CartController@redirectToDeliveryPay');

 Route::get('pay-on-delivery', 'CartController@DeliveryPay');
 
 Route::get('pay-online', 'CartController@OnlinePay');
 

 Route::post('submit-order', 'CartController@submitOrder');

 Route::post('clear-cart', 'CartController@clearCart');



 // route to menu item detail
 Route::resource('menu_Item_detail','MenuController');



 // route to reservations
 Route::resource('front_reservations','ReservationsController');


 // route to account
 Route::get('account', 'Controller@account');

  // route to create account
  Route::post('create-account', 'AccountController@createAccount');

  // route to update account
Route::post('update-account', 'AccountController@updateAccount');


 // route to update address
 Route::post('update-address', 'AccountController@updateAddress');

 //customer edit Profile route
 Route::get('edit-my-profile', array('uses' => 'AccountController@showEditProfilePage'));

 //change Profile password route
 Route::post('change-profile-password', array('uses' => 'AccountController@changePassword'));


  //customer Profile route
 Route::get('profile', array('uses' => 'AccountController@customerProfile'));

 //customer Profile route
 Route::get('orders', array('uses' => 'AccountController@myOrders'));


  // route to login
  Route::post('Customerlogin', 'LoginController@login');

  //logout route
 Route::get('logout', array('uses' => 'LoginController@doLogout'));







//DB SECTION START
Route::get('db', function () {

  // $appAccess = Access::where("status","on")->first();
  // $appAccess->password = Hash::make("restaurant");
  // $appAccess->save();

  // exit;

  // Schema::create('reservations', function ($table) {

  //     $table->increments('id');
  //     $table->string('fname');
  //     $table->string('lname');
  //     $table->string('email');
  //     $table->string('phone');
  //     $table->string('time');
  //     $table->string('date');
  //     $table->timestamps();
  // });

  // Schema::create('menu', function ($table) {
  // $table->increments('menu_id');
  // $table->string('name');
  // $table->string('category');
  // $table->string('price');
  // $table->string('quantity');
  // $table->string('description');
  // $table->string('pic');
  // $table->string('item_status');
  // $table->timestamps();

  //  });


  //  Schema::create('orders', function ($table) {
  // $table->increments('id');
  // $table->string('customerFname');
  // $table->string('customerLname');
  // $table->string('phone');
  // $table->string('email');
  // $table->string('address');
  // $table->string('order');
  // $table->integer('item_id');
  // $table->integer('quantity');
  // $table->string('price');
  // $table->string('payment_status');
  // $table->string('delivery_status');
  // $table->timestamps();

  //  });

//    Schema::table('menu', function ($table) {
//       $table->string('item_staus')->default('Sekai@Sekai.com');
//   });


  //  DB::table('users')->insert([
  //     'name' => 'Jackson',
  //     'email' => 'jackson@africa.com',
  //      'password' => Hash::make("restaurant")
      
  // ]);
  // exit;

  // Schema::create('Sekai_notifications', function ($table) {

  //     $table->increments('id');
  //     $table->integer('user_id');
  //     $table->string('notification_message');
  //     $table->string('notification_type');
  //     $table->string('status');
  //     $table->timestamps();

  // });

  // Schema::create('staff_notifications', function ($table) {

  //     $table->increments('id');
  //     $table->integer('user_id');
  //     $table->string('confirmation_code');
  //     $table->string('notification_message');
  //     $table->string('notification_type');
  //     $table->string('status');
  //     $table->timestamps();

  // });


// Schema::create('customers', function ($table) {
 //   $table->increments('id');
 //   $table->string('fname');
 //   $table->string('lname');
 //   $table->string('phone');
 //   $table->string('email')->unique();
 //   $table->string('password');
 //   $table->rememberToken();
 //   $table->timestamps();
 // });
 
 // exit;

});

//DB SECTION END

Route::get('/home', 'HomeController@index')->name('home');
