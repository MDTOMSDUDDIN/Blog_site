<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;



class AuthorController extends Controller
{
    function author_register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>['required','unique:authors'],
            'password'=>['required',Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
        ]);
        Author::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('author_register','Registation Successfully ! Your Account is Pending for Approval, you will get confirmation Email When Your Account Active ?');
    }
    
      function author_login(Request $request){
        if(Author::where('email',$request->email)->exists()){
            if(Auth::guard('author')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                 if(Auth::guard('author')->user()->status != 1){
                   Auth::guard('author')->logout();
                    return back()->with('pending','Your Account is Pending for  Approval ');
                 }else{
                  return redirect()->route('index');
                 }
                }else{
                 return back()->with('pass_wrong','Wrong Passsword ?');  
                }

        }else{
            return back()->with('email_exists','Your email Does not Exists');  
        }
      }
       
      function author_logout(){
        Auth::guard('author')->logout();
        return redirect('/');
      }
      
      function author_dashboard(){
        return view('frontend.author.admin');
      }

}