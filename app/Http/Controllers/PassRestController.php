<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\PassReset;
use App\Notifications\PassResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
 


class PassRestController extends Controller
{
    function pass_reset_req(){
        return view('frontend.author.pass_reset_req');
    }
    function pass_reset_req_post(Request $request){
        $Author_info = Author::where('email',  $request->email)->first();
        if(Author::where('email',$request->email)->exists()){
          if(PassReset::where ('author_id',$Author_info->id)->exists()){
            PassReset::where ('author_id',$Author_info->id)->delete();
          }
          $author = PassReset::create([
            'author_id'=>$Author_info->id,
            'token'=>uniqid(),
        ]);
        Notification::send($Author_info, new PassResetNotification($author));
        return back()->with('success',"We Have Sent You a Password Reset Link To $request->email!");
        }else{
                return back()->with('exist','Email not found!');
                }
            }
    function pass_reset_form($token){
        if(PassReset::where('token',$token)->exists()){
            return view('frontend.author.pass_reset_form',[
                'token'=>$token,
            ]);
        }else{
            return redirect()->route('pass.reset.req')->with('link','Invalid Password Reset Link!');
        }
        
    }

    function pass_reset_update(Request $request,$token){
        $author = PassReset::where('token',$token)->first();
        
        if(PassReset::where('token',$token)->exists()){
            Author::find($author->author_id)->update([
                'password'=>bcrypt($request->password),
            ]);
            PassReset::where('token',$token)->delete();
            return redirect()->route('author.login.page')->with('reset','Password Reset Successfully!');
        }else{
            return redirect()->route('pass.reset.req')->with('link','Invalid Password Reset Link!');
        }
    }


}
