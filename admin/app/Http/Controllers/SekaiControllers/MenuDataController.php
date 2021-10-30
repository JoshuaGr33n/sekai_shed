<?php

namespace App\Http\Controllers\SekaiControllers;
use App\Http\Controllers\Controller;

use App\SekaiModels\MenuData;
use App\SekaiModels\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Storage;
use DB;



class MenuDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function itemOrderHistory($id, Request $request)
    {
        


        $itemOrders = OrdersModel::latest()->paginate(5);
        $itemOrders = $itemOrders->where('item_id', $id);

        
        
        

  
        return view('sekai.item_order_history',compact('itemOrders'))->with('i', (request()->input('page', 1) - 1) * 5);
    }



    public function deleteItemOrder($id, Request $request)
    {
         

            OrdersModel::find($id)->delete();
  
        return Redirect::to('sekai_menu_data/'.$id.'/item_order_history')
                        ->with('delete_success','Record deleted successfully');
    }





    public function backItemOrderHistory($id, Request $request)
    {
        
              
  
        return Redirect::to('sekai_menu_data/'.$id);
    }


    //transfer menu table values to order history page
    public function viewMenuItemInfo($id, Request $request)
    {
        


        $MenuData2 = MenuData::find($id);
        return view('sekai.item_order_history',compact('MenuData','id'));
    }










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
        $special = $request->get('special');
        if($special){
            $special="Yes";
        }
        else{
            $special="No";
        }


        if ($request->hasFile('image')) {
            
            if ($request->file('image')->isValid()) {
                //
                $this->validate($request,[
                      'name' => 'required',
                     'category' => 'required',
                      'price' => 'required',
                     'description' => 'required',
                     'item_status' => '',
                    'image' => 'mimes:jpeg,png|max:5014',
                ]);
                $extension = $request->image->extension();
                $request->image->storeAs('sekai/img', request('name').".".$extension);
                $url = Storage::url('app/sekai/img/'.request('name').".".$extension);

                //check duplicate entries
                $check = MenuData::where('name', request('name'))->first();
                if ($check) {
                 return Redirect::to('sekaiMenu')
                ->with('duplicateERROR','Item already exist.');
                     }

                else{
                    $category = implode(", ", $request->get('category'));
                    $MenuData = MenuData::create([
    
                    'pic' => $url,
                    'name' => request('name'),
                    'category' => $category,
                    'price' => request('price'),
                    'description' => request('description'), 
                    'specials' => $special,
                   
                ]);
               }
              
            }
        }else{
         

          $this->validate($request,[
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'item_status' => '',
           

            
            
         ]);

         //check duplicate entries
         $check = MenuData::where('name', request('name'))->first();
         if ($check) {
            return Redirect::to('sekaiMenu')
            ->with('duplicateERROR','Item already exist.');
         }
         else{
            // MenuData::create($request->all());
            $category = implode(", ", $request->get('category'));
            $MenuData = MenuData::create([
              'name' => request('name'),
              'category' => $category,
              'price' => request('price'),
              'description' => request('description'),
              'specials' => $special,
             
          ]);
         }
        
        }


        return Redirect::to('sekaiMenu')
                        ->with('success','Item added successfully.');
    }















    /**
     * Display the specified resource.
     *
     * @param  \App\MenuData  $MenuData
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        

           // check if url Id exist
            $check = MenuData::where('id', $id)->first();
            if (!$check) {
              return Redirect::to('sekaiMenu');
                  }

        $MenuData = MenuData::find($id);
        return view('sekai.menu_item',compact('MenuData'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuData  $MenuData
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
       
               // check if url Id exist
            $check = MenuData::where('id', $id)->first();
            if (!$check) {
              return Redirect::to('sekaiMenu');
                  }



        $MenuData = MenuData::find($id);
        $menu_categories = DB::select('select * FROM sekai_categories');
        return view('sekai.edit_menu_item',['menu_categories'=>$menu_categories], compact('MenuData','id'));
    }















    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuData  $MenuData
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {   
        $category = $request->get('categoryHidden');
        if($request->get('category')){
         $category = implode(', ', $request->get('category'));
         $category =   rtrim($category, ',');
        }
        $special = $request->get('special');
       


        
        $MenuData = MenuData::find($id);
        
        if ($request->hasFile('image')) {
          
            if ($request->file('image')->isValid()) {
                //
                $this->validate($request,[
                    
                    'image' => 'mimes:jpeg,png|max:10014',
                ]);
                $extension = $request->image->extension();
                $request->image->storeAs('sekai/img', $id.".".$extension);
                $url = Storage::url('app/sekai/img/'.$id.".".$extension);
                $MenuData->pic = $url;
                $MenuData->save();
                
            }
        }
        $this->validate($request,[
          'name' => 'required',
          'price' => 'required',
          'description' => 'required',
         
       ]);
      
      

    //    foreach($checkbox1 as $chk1)  
    //      {  
    //        $chk .= $chk1.",";  
    //      } 
       
    
             //check duplicate entries
           $check =  DB::select("select * FROM sekai_menu WHERE name='$request->name' AND id NOT IN('$id')");
           if ($check) {
               return Redirect::to('sekai_menu_data/'.$id.'/edit')->with('duplicateERROR','Item Name already exist. Name should be unique');
             }else{
        
              $MenuData->name = request('name');
              $MenuData->category = $category;
              $MenuData->price = request('price');
              $MenuData->description = request('description');
              $MenuData->specials= $special;
              $MenuData->save();
             }

        
       

               
                   $MenuData->update($request->all());
                 
     
        return Redirect::to('sekai_menu_data/'.$id.'/edit')->with('success','Item updated successfully');
    }















     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuData  $MenuData
     * @return \Illuminate\Http\Response
     */
    public function updateMenuStatus($id, Request $request)
    {
    
        $MenuData = MenuData::find($id);
        $MenuData->item_status= request('item_status');
        $MenuData->save();
        $this->validate($request,[
            'item_status' => 'required',

         ]);
        $MenuData->update($request->all());
  
        return Redirect::to('sekai_menu_data/'.$id)
                        ->with('success','Item updated successfully');
    }














    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuData  $MenuData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
     
        // MenuData::find($id)->delete();

        // DB::delete("DELETE FROM menu WHERE id='$id'");
        DB::table('sekai_menu')->where('id', request('sno'))->delete();
  
        return Redirect::to('sekaiMenu')->with('delete_success','Record deleted successfully');
    }
}