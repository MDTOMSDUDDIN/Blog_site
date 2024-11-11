<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Pass_Reset;
use App\Notifications\PassResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
 


class PassResetController extends Controller
{
   function pass_reset_req(){
      return view('frontend.author.pass_reset_req');
   }

   function pass_reset_req_send(Request $request){
     $author_info=Author::where('email', $request->email)->first();
    if(Author::where('email', $request->email)->exists()){
       if(Pass_Reset::where('author_id',$author_info->id)->exists()){
        Pass_Reset::where('author_id',$author_info->id)->delete();
       }
        $author=Pass_Reset::create([
         'author_id'=>$author_info->id,
         'token'=>uniqid(),
        ]);
        Notification::send($author_info, new PassResetNotification($author));
        return back()->with('success', "we have send a password Reset links -  $request->email");

    }else{
        return back()->with('exists', 'Email Does not Exists ?');
    }
   }

   function pass_reset_form($token){
    if(Pass_Reset::where('token', $token)->exists()){
        return view('frontend.author.pass_reset_form',[
            'token'=>$token,
        ]);
    }else{
        return redirect()->route('pass.reset.req')->with('links', "Your password links invaild");
    }  
   }

   function pass_reset_update(Request $request, $token){
    $author=Pass_Reset::where('token', $token)->first();
    if(Pass_Reset::where('token', $token)->exists()){
        Author::find($author->author_id)->update([
            'password'=>bcrypt($request->password),
        ]);
        Pass_Reset::where('token', $token)->delete();

        return redirect()->route('author.login.page')->with('reset', " password Reset Successfully");
    }else{
        return redirect()->route('pass.reset.req')->with('links', "Your password links invaild");
    }
   }
}
