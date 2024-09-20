<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PostController extends Controller
{
    function add_post(){
        $categories=Category::all();
        $tags=Tag::all();
        return view('frontend.author.add_post',[
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }

    function post_store(Request $request){
//preview 
     $preview = $request->preview;
     $extension = $preview->extension();
     $preview_name = uniqid() . '.' . $extension;
 
     $manager = new ImageManager(new Driver());
     $image = $manager->read($preview);
     $image->resize(300, 300);
     $image->save(public_path('uploads/post/preview/' . $preview_name));
 
//preview 
     $thumbnail = $request->thumbnail;
     $extension = $thumbnail->extension();
     $thumbnail_name = uniqid() . '.' . $extension;
 
     $manager = new ImageManager(new Driver());
     $image = $manager->read($thumbnail);
     $image->resize(300, 200);
     $image->save(public_path('uploads/post/thumbnail/' . $thumbnail_name));
    
    Post::insert([
        'author_id' => auth()->guard('author')->id(),
        'category_id' => $request->category_id,
        'read_time' => $request->read_time,
        'title' => $request->title,
        'desp' => $request->desp ?? 'No description provided',  // Fallback if description is null
        'tags' => implode(',', $request->tag_id ?? []),
        'preview' => $preview_name,
        'thumbnail' => $thumbnail_name,
        'created_at' => Carbon::now(),
    ]);

    return back()->with('post', 'New Post Add Successfull !!!!');
}
}
