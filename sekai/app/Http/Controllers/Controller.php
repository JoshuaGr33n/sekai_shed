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


use App\MenuModel;
use View;
use Input;
use Redirect;
use Auth;

use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    
    public function home(Request $request)
    {

    
        $menuHome = DB::select('select * FROM sekai_menu Where item_status IN("Available") ORDER BY created_at DESC LIMIT 10');
        $specials = DB::select('select * FROM sekai_menu Where specials="Yes" AND item_status IN("Available") ORDER BY created_at DESC');
        return view('home',['menuHome'=>$menuHome,'specials'=>$specials])->with('i', (request()->input('page', 1) - 1) * 5);

       
    }

    

    public function menu(Request $request)
    {
        $menu = MenuModel::orderBy('created_at', 'DESC')->where('item_status', '=', 'Available')->paginate(10);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($menu as $key => $menu) {
                if(!empty($menu->pic)){
                $artilces.='
                <div class="menu-item3 col-sm-6 col-xs-12 '.$menu->category.'">
                 <img src="http://localhost/admin/'.$menu->pic.'" class="img-responsive" alt="" style="height:100px; width:18%"/>
                 <div class="menu-wrapper">
                    <h4><a href="menu_Item_detail/'.$menu->id.'">'.$menu->name.'</a></h4>
                    <span class="price">#'.$menu->price.'</span>
                    <div class="dotted-bg"></div>
                    <p>'.$menu->category.'</p>
                 </div>
               </div>';
                }
                else{
                    $artilces.='
                    <div class="menu-item3 col-sm-6 col-xs-12 '.$menu->category.'">
                     <img src="public/img/no-img.png" class="img-responsive" alt="" style="height:100px; width:18%"/>
                     <div class="menu-wrapper">
                        <h4><a href="menu_Item_detail/'.$menu->id.'">'.$menu->name.'</a></h4>
                        <span class="price">#'.$menu->price.'</span>
                        <div class="dotted-bg"></div>
                        <p>'.$menu->category.'</p>
                     </div>
                   </div>';
                }
            }
            return $artilces;
        }
        return view('menu');
    }
    
    
   

    public function reservation(Request $request)
    {
        
        return view('reservation');

    }


    public function about(Request $request)
    {
        $menuAbout = DB::select('select * FROM sekai_menu Where item_status IN("Available") ORDER BY created_at DESC LIMIT 10');
        return view('about',['menuAbout'=>$menuAbout])->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function gallery(Request $request)
    {
        $gallery =  MenuModel::orderBy('created_at', 'DESC')->where('item_status', '=', 'Available')->paginate(6);

        $artilces = '';
        if ($request->ajax()) {
            foreach ($gallery as $key => $gallery) {
                if(!empty($gallery->pic)){
                $artilces.='
                <div class="col-md-4 col-sm-6">
                <div class="gallery-item" data-mfp-src="http://localhost/admin/'.$gallery->pic.'">
                    <img src="http://localhost/admin/'.$gallery->pic.'" class="img-responsive" alt="" style="height:300px;border:1px solid #ccc;padding:5px 5px 5px 5px"/>
                    <div class="gi-overlay">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
            </div>';
                }
            }
            return $artilces;
        }
        return view('gallery');

    }
    


    public function shop(Request $request)
    {
        
        $categories =  DB::select('SELECT * FROM sekai_categories');

        $products =  MenuModel::orderBy('created_at', 'DESC')->where('item_status', '=', 'Available')->paginate(10);
        

        $newArrivals=  MenuModel::orderBy('created_at', 'DESC')->where('item_status', '=', 'Available')->paginate(5);


        

        $artilces = '';
        if ($request->ajax()) {
            foreach ($products as $key => $products) {
                if(!empty($products->pic)){
                $artilces.='
                <div class="col-md-4 col-sm-6">
                <div class="product-info">
                    <div class="product-img">
                        <img src="http://localhost/admin/'.$products->pic.'" alt="" class="img-responsive" style="height:250px; width:100%"/>
                    </div>
                    <h4><a href="menu_Item_detail/'.$products->id.'">'.$products->name.'</a></h4>
                    <div class="rc-ratings">
                       
                    </div>
                    <div class="product-price">#'.$products->price.'</div>
                    <div class="shop-meta">
                    <p class="btn-holder"><a href="javascript:void(0);" data-id="'.$products->id.'" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                    <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                </p>
                      
                    </div>
                </div>
            </div>';
                }else{
                    $artilces.='
                    <div class="col-md-4 col-sm-6">
                    <div class="product-info">
                        <div class="product-img">
                            <img src="public/img/no-img.png" alt="" class="img-responsive" style="height:250px; width:100%"/>
                        </div>
                        <h4><a href="menu_Item_detail/'.$products->id.'">'.$products->name.'</a></h4>
                        <div class="rc-ratings">
                            
                        </div>
                        <div class="product-price">#'.$products->price.'</div>
                        <div class="shop-meta">
                        <p class="btn-holder"><a href="javascript:void(0);" data-id="'.$products->id.'" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                    </p>
                          
                        </div>
                    </div>
                </div>';
                }
            }
           
            return $artilces;
        }

        return view('shop',['newArrivals'=>$newArrivals,'categories'=>$categories]);
    }






    public function menuCategory(Request $request, $category)
    {
        
        $categories =  DB::select('SELECT * FROM sekai_categories');
        
        $cat =  DB::select("SELECT * FROM sekai_categories WHERE category='$category'");

        $products =   MenuModel::orderBy('created_at', 'DESC')->where([ ['item_status', '=', 'Available'],['category',  'like', '%' . $category . '%']])->paginate(10);

        $newArrivals=  MenuModel::orderBy('created_at', 'DESC')->where('item_status', '=', 'Available')->paginate(5);


        

        $artilces = '';
        if ($request->ajax()) {
            foreach ($products as $key => $products) {
                if(!empty($products->pic)){
                $artilces.='
                <div class="col-md-4 col-sm-6">
                <div class="product-info">
                    <div class="product-img">
                        <img src="http://localhost/admin/'.$products->pic.'" alt="" class="img-responsive" style="height:250px; width:100%"/>
                    </div>
                    <h4><a href="/sekai/menu_Item_detail/'.$products->id.'">'.$products->name.'</a></h4>
                    <div class="rc-ratings">
                       
                    </div>
                    <div class="product-price">#'.$products->price.'</div>
                    <div class="shop-meta">
                    <p class="btn-holder"><a href="javascript:void(0);" data-id="'.$products->id.'" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                    <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                </p>
                      <input type="hidden" value="'.$products->id.'" data-id="cat" name="cat"/>
                    </div>
                </div>
            </div>';
                }else{
                    $artilces.='
                    <div class="col-md-4 col-sm-6">
                    <div class="product-info">
                        <div class="product-img">
                            <img src="http://localhost/admin/public/img/no-img.png" alt="" class="img-responsive" style="height:250px; width:100%"/>
                        </div>
                        <h4><a href="/sekai/menu_Item_detail/'.$products->id.'">'.$products->name.'</a></h4>
                        <div class="rc-ratings">
                            
                        </div>
                        <div class="product-price">#'.$products->price.'</div>
                        <div class="shop-meta">
                        <p class="btn-holder"><a href="javascript:void(0);" data-id="'.$products->id.'" class="btn btn-warning btn-block text-center add-to-cart" role="button">Add to cart</a>
                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                    </p>
                          
                        </div>
                    </div>
                </div>';
                }
            }
           
            return $artilces;
           
        }

        return view('menu_category',['cat'=>$cat,'newArrivals'=>$newArrivals,'categories'=>$categories]);
    }
    


    // public function asideShop($id, Request $request)
    // {
         

    //         // check if url Id exist
    //          $check = MenuModel::where('id', $id)->where('item_status', '=', 'Available')->first();
    //          if (!$check) {
    //           return Redirect::to('menu');
    //             }

       
    //      $newArrivals=  MenuModel::orderBy('created_at', 'DESC')->paginate(5);
    //      $categories =  DB::select('SELECT * FROM sekai_categories'); 
    //     return view('aside',['newArrivals'=>$newArrivals,'categories'=>$categories]);
       
    // }


    public function contact(Request $request)
    {
        
        return view('contact');

    }



    public function account(Request $request)
    {
        
        return view('account');

    }






 
    








 
    
}
