<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class UserController extends Controller
{
    function users(){
        $users=User::all();
        return view('admin.user.users',compact('users'));
    }

    function user_delete($user_id){
        $user=User::find($user_id);
        if($user->photo != null){
            $delete_image=public_path('uploads/user/'.$user->photo);
            unlink($delete_image);
        }
       User::find($user_id)->delete();

       return back()->with('del','User Delete Successfull !!');
    }

    function add_user(Request $request){
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('Add_user','New User Add Successfully !');
    }


 //edit name,email update profile   
    function edit_profile(){
        return view('admin.user.edit_profile');
    }
    function update_profile(Request $request){
       User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
       ]);
       return back()->with('profile','Profile Update Sucessfully !!');
    }

//password update section section update_password
    function update_password(PasswordRequest $request){
       if(Hash::check($request->current_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('pass','password Changed');
       }else{
        return back()->with('err','Current Password Does not Match ');
       }
    }
      
    function update_photo(Request $request){
        $request->validate([
        'photo'=>['required','mimes:jpg,png', 'max:1024'],
        ]);

        if(Auth::user()->photo !=null){
            $delete=public_path('uploads/user/'.Auth::user()->photo);
            unlink($delete);
        }

        $photo=$request->photo;
        $extension=$photo->extension();
        $file_name=uniqid().'.'.$extension;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image->resize(200, 200);
        $image->save(public_path('uploads/user/'.$file_name));

        User::find(Auth::id())->update([
            'photo'=>$file_name,
        ]);
        return back()->with('photo','photo Updated ');
    }
}
