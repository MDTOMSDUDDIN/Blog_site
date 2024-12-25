<?php

namespace App\Http\Controllers;

use App\Mail\AuthorVerifyMail;
use App\Models\Author;
use App\Models\EmailVerify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Mail;

class AuthorController extends Controller
{
    function author_register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>['required','unique:authors'],
            'password'=>['required', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()]


        ]);
        $author_id =Author::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        $author = EmailVerify::create([
            'author_id'=>$author_id,
            'token'=>uniqid(),
            

        ]);



        
        Mail::to($request->email)->send(new AuthorVerifyMail($author));
        

        // return back()->with('author_register','Registrations Success!Your Account is pending for Approval!We will get confirmation mail when your account will active!');
        return back()->with('verify',"We have sent you a verification email to $request->email!");
        
    }

    function author_login(Request $request){
        // Check if the email exists in the database
        if (Author::where('email', $request->email)->exists()) {
            // Attempt to authenticate with email and password
            if (Auth::guard('author')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // Check if email is verified
                if (Auth::guard('author')->user()->email_verified_at != null) {
                    // Check if account status is approved
                    if (Auth::guard('author')->user()->status != 1) {
                        Auth::guard('author')->logout();
                        return back()->with('pending', 'Your Account Is Pending For Approval!');
                    } else {
                        return redirect()->route('index');
                    }
                } else {
                    Auth::guard('author')->logout();
                    return back()->with('not_verify', 'Your Email Is Not Verified!');
                }
            } else {
                // Password is wrong
                return back()->with('pass_wrong', 'Wrong Password!');
            }
        } else {
            // Email does not exist
            return back()->with('exist', 'Email Does Not Exist!');
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
        $request->validate([
            'name'=>'required',
            'email'=>['required','unique:authors,email,'.Auth::guard('author')->id()],
        ]);

        if($request->photo == ''){
            Author::find(Auth::guard('author')->id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
            ]);
            
        return back()->with('profile','Profile Update Successfully!');
        }else{
            if(Auth::guard('author')->user()->photo != null){
                $delete_from = public_path('uploads/author/'.Auth::guard('author')->user()->photo);
                unlink($delete_from);
            }
            $photo =$request->photo;
            $extension = $photo->extension();
            $file_name = uniqid().'.'.$extension;

            $manager=new ImageManager(new Driver());
            $image = $manager->read($photo);
            $image->resize(200,200 );
            $image->save(public_path('uploads/author/'.$file_name));

            Author::find(Auth::guard('author')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'photo'=>$file_name,
            ]);

        return back()->with('profile','Profile Update Successfully!');
        }
    }
    public function author_pass_update(Request $request) {
        // Validate the input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
    
        // Check if the current password matches
        if (Hash::check($request->current_password, Auth::guard('author')->user()->password)) {
            // Update the new password
            Author::find(Auth::guard('author')->id())->update([
                'password' => Hash::make($request->password),
            ]);
    
            return back()->with('pass', 'Password Changed Successfully!');
        } else {
            return back()->with('err', 'Current Password Does Not Match!');
        }
    }

    function author_verify($token){
        $author = EmailVerify::where('token', $token)->first();

        if(EmailVerify::where('token',$token)->exists()){
            Author::find($author->author_id)->update([
                'email_verified_at'=>Carbon::now(),
               
            ]);
            EmailVerify::where('token', $token)->delete();

          return redirect()->route('author.login.page')->with('verified','Your Email is Verified!');
        }else{
            abort('404');
        }

    }

    function request_verify(){
        return view ('frontend.author.request_verify');
    }

    function request_verify_send(Request $request){
        $author = Author::where('email',$request->email)->first();
        if(EmailVerify::where('author_id',$author->id)->exists()){
            EmailVerify::where('author_id',$author->id)->delete();
        }

        $author = EmailVerify::create([
            'author_id'=>$author->id,
            'token'=>uniqid(),
            
        ]);
        
        Mail::to($request->email)->send(new AuthorVerifyMail($author));

        return back()->with('verify',"We have sent you a verification email to $request->email!");
    }
    
    
}
