<?php

namespace App\Http\Controllers;

use App\Mail\AuthorVerifyMail;
use App\Models\Author;
use App\Models\EmailVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Mail;


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
        $author_id=Author::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        
      $author= EmailVerify::create([
          'author_id'=>$author_id,
          'token'=>uniqid(),
           
        ]);

        Mail::to($request->email)->send(new AuthorVerifyMail($author));
        return back()->with('verify',"We have send you a varification email to $request->email ");
        // return back()->with('author_register','Registation Successfully ! Your Account is Pending for Approval, you will get confirmation Email When Your Account Active ?');
    }
    
      function author_login(Request $request){
        if(Author::where('email',$request->email)->exists()){
            if(Auth::guard('author')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                 if(Auth::guard('author')->user()->email_verified_at !=null){
                    if(Auth::guard('author')->user()->status != 1){
                      Auth::guard('author')->logout();
                      return back()->with('pending','Your Account is Pending for  Approval ');
                    }else{
                      return redirect()->route('index');
                    }
                 }else{
                  Auth::guard('author')->logout();
                  return back()->with('not_verify','Your email account is not verified ??? ');
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
      function author_edit(){
        return view('frontend.author.edit');
      }
      function author_profile_update(Request $request){
        if($request->photo ==''){
          Author::find(Auth::guard('author')->id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
          ]);
          return back();

        }else{
          if(Auth::guard('author')->user()->photo !=null){
            $delete=public_path('uploads/author/'.Auth::guard('author')->user()->photo);
            unlink($delete);
        }

        $photo=$request->photo;
        $extension=$photo->extension();
        $file_name=uniqid().'.'.$extension;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($photo);
        $image->resize(200, 200);
        $image->save(public_path('uploads/author/'.$file_name));
        Author::find(Auth::guard('author')->id())->update([
          'name'=>$request->name,
          'email'=>$request->email,
          'photo'=>$file_name,
        ]);
        return back()->with('update','Profile Update Successfull !');
        }
      }
      function author_pass_update(Request $request){
        if(Hash::check($request->current_password,Auth::guard('author')->user()->password)){
           Author::find(Auth::guard('author')->id())->update([
               'password'=>bcrypt($request->password),
           ]);
           return back()->with('update','Password Change Successfully !');
        }else{
          return back()->with('wrong','YOur Current Password Does not Match ????');
        }
      }

//author email verifiy 
        function author_verify($token) {
              $author = EmailVerify::where('token', $token)->first();
              if(EmailVerify::where('token', $token)->exists()){
                if (!$author) {
                    return redirect()->route('author.login.page')->with('error', 'Invalid or expired token.');
                }
                Author::find($author->author_id)->update([
                    'email_verified_at' => Carbon::now(),
                ]); 
              }else{
                abort(404);
              }
              EmailVerify::where('token', $token)->delete();

              return redirect()->route('author.login.page')->with('verify', 'Your email is verified.');
          }
        
        function request_verify(){
          return view("frontend.author.request_verify");
        }
        function request_verify_send(Request $request){
          $author=Author::where('email', $request->email)->first();

          if(EmailVerify::where('author', $author->id)->exists()){
            EmailVerify::where('author', $author->id)->delete();
          }

          $author= EmailVerify::create([
            'author_id'=>$author->id,
            'token'=>uniqid(),
             
          ]);
  
          Mail::to($request->email)->send(new AuthorVerifyMail($author));
          return back()->with('verify',"We have send you a varification email to $request->email ");

        }
}