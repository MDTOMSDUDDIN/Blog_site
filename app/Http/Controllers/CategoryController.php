<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PhpParser\Node\Stmt\Foreach_;

class CategoryController extends Controller
{
    function category(){
        $categories=category::all();
        return view('admin.category.category',compact('categories'));
    }

    function category_store(Request $request){
        $request->validate([
            'category_name'=>['required','unique:categories'],
            'category_image'=>['required','mimes:png,jpg', 'max:2024'],

        ]);


        $cat_img=$request->category_image;
        $extension=$cat_img->extension();
        $file_name=uniqid().'.'.$extension;

        
        $manager = new ImageManager(new Driver());
        $image = $manager->read($cat_img);
        $image->resize(200, 200);
        $image->save(public_path('uploads/category/'.$file_name));

        category::insert([
            'category_name'=>$request->category_name,
            'category_image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('Category_add','Category Add Successfull !');
      
    }
//category edit section 
        function category_edit($category_id){
            $category=category::find($category_id);
            return view('admin.category.edit',compact('category'));
        }

        function category_update(Request $request , $category_id){
            $category=category::find($category_id);
            $request->validate([
                'category_name'=>'unique:categories',
                'category_image'=>['mimes:jpg,png','max:2024'],

            ]);
            if($request->category_image !=''){
                $request->validate([
                'category_image'=>['mimes:jpg,png','max:2024'],
              ]);
            $delete_form=public_path('uploads/category/'. $category->category_image);
            unlink($delete_form);

            $cat_img=$request->category_image;
            $extension=$cat_img->extension();
            $file_name=uniqid().'.'.$extension; 
    
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($cat_img);
            $image->resize(200, 200);
            $image->save(public_path('uploads/category/'.$file_name));
            
            category::find($category_id)->update([
                'category_name'=>$request->category_name,
                'category_image'=>$file_name,
            ]);
            return redirect()->route('category')->with('updated','Category Updated Successfull ');
        
            }
        }
//category softDelete option 
            function category_delete($category_id){
                category::find($category_id)->delete();
                return back()->with('category_del','Category Deleted Successfull ');
            }
          
//trash delete 
            function trash(){
                $trash_cat=Category::onlyTrashed()->get();
                return view('admin.category.trash',compact('trash_cat'));
            }
            function category_restore($category_id){
                Category::onlyTrashed()->find($category_id)->restore();
                return back()->with('restore','Category restore Successfull ');
            }
            function category_hard_delete($category_id){
                $category=Category::onlyTrashed()->find($category_id);
                $delete_form=public_path('uploads/category/'.$category->category_image);
                unlink($delete_form);

                Category::onlyTrashed()->find($category_id)->forceDelete();
                return back()->with('permanently_delete', 'Category permanently deleted Successfull ');
            }
         function category_ckeck_delete(Request $request){
            foreach($request->category_id as $cat_id){
                Category::find($cat_id)->delete();
            }
            return back()->with('category_del','Category Deleted Successfull ');
         }
//trash Checked Delete&restore
         function category_ckeck_restore(Request $request){
            if($request->action_btn == 1){
                foreach($request->category_id as $cat_id){
                 Category::onlyTrashed()->find($cat_id)->restore();
                 }
                return back()->with('restore','Category restore Successfull ');
            }else{
                foreach($request->category_id as $cat_id){
                    $category=Category::onlyTrashed()->find($cat_id);
                    $delete_form=public_path('uploads/category/'.$category->category_image);
                    unlink($delete_form);
                   Category::onlyTrashed()->find($cat_id)->forceDelete();
                 }
                 return back()->with('permanently_delete',' Checked Category Deleted Successfull ');
            }
            
          
        }
}

