<?php

namespace App\Http\Controllers\SekaiControllers;
use App\Http\Controllers\Controller;

use App\SekaiModels\CategoriesModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DB;




class CategoriesController extends Controller
{

  
    public function sekaiStoreCategory(Request $request)
    {
        $category = request('category_name');
        $category = strtolower($category);
        $this->validate($request,[
            'category_name' => 'required',
        ]);
        //check for duplicate
        $check = CategoriesModel::where('category',$category)->first();
        if ($check) {
            return Redirect::to('sekaiCategories')
            ->with('duplicate_err',$category.' already exist.');
            }
        else{
            CategoriesModel::create([
            'category' => $request->category_name
           
        ]);
       }

        return Redirect::to('sekaiCategories')
        ->with('success',$category.' added successfully.');

        // return response()->json(
        //     [
        //         'success' => true,
        //         'message' => 'Data inserted successfully'
        //     ]
        // );
    }


    public function update($id, Request $request)
    {
        $category = request('category_name');
        $category = strtolower($category);
     //check for duplicate
     $check = DB::select("SELECT * FROM sekai_categories WHERE category='$category' AND id NOT IN('$id')");
     if ($check) {
         return Redirect::to('sekaiCategories')
         ->with('duplicate_err',$category.' already exist.');
         }
     else{
        $CategoryData = CategoriesModel::find($id);


       ///update menu
        $check_menu_category = DB::select("SELECT * FROM sekai_menu WHERE category like '%$CategoryData->category%'");
        if($check_menu_category){
              DB::update("UPDATE sekai_menu SET category = REPLACE(category,'$CategoryData->category','$category')");
        }
        ///update menu


        $CategoryData->category= $category;

        $CategoryData->save();
        $this->validate($request,[
            'category_name' => 'required',

         ]);
        $CategoryData->update($request->all());


      
        
      
        }


       
        return Redirect::to('sekaiCategories')
                        ->with('update_success','Category updated successfully');
                       
    }


    public function destroy($id, Request $request)
    {
     
        DB::table('sekai_categories')->where('id', request('sno'))->delete();
  
        return Redirect::to('sekaiCategories')->with('delete_success','Category deleted successfully');
    }
}