<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
Use Illuminate\Support\Str;
class PostController extends Controller
{
    function add_post(){
        $categories = Category::all();
        $tags =Tag::all();
        return view('frontend.author.add_post',[
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }
    function post_store(Request $request){
        
       


        // Check if 'preview' image is uploaded
        if (!$request->hasFile('preview')) {
            return back()->withErrors(['preview' => 'Preview image is required.'])->withInput();
        }
    
        // Check if 'thumbnail' image is uploaded
        if (!$request->hasFile('thumbnail')) {
            return back()->withErrors(['thumbnail' => 'Thumbnail image is required.'])->withInput();
        }
    
        // Proceed with image processing as both images are present
    
        // Preview image processing
        $preview = $request->file('preview'); // Use file() to get the UploadedFile instance
        $extension = $preview->extension();
        $preview_name = uniqid() . '.' . $extension;
    
        $manager = new ImageManager(new Driver());
        $image = $manager->read($preview);
        $image->resize(1000, 600);
        $image->save(public_path('uploads/post/preview/' . $preview_name));
    
        // Thumbnail image processing
        $thumbnail = $request->file('thumbnail');
        $extension = $thumbnail->extension();
        $thumbnail_name = uniqid() . '.' . $extension;
    
        $manager = new ImageManager(new Driver());
        $image = $manager->read($thumbnail);
        $image->resize(300, 200);
        $image->save(public_path('uploads/post/thumbnail/' . $thumbnail_name));
    
        // Insert post data into the database
        Post::insert([
            'author_id' => auth()->guard('author')->id(),
            'category_id' => $request->category_id,
            'read_time' => $request->read_time,
            'title' => $request->title,
            'slug' => Str::lower(str_replace(' ', '-', $request->title)).'-'.random_int(10000,200000),
            'desp' => $request->desp ?? 'No description provided',  // Fallback if description is null
            'tags' => implode(',', $request->tag_id ?? []),
            'preview' => $preview_name,
            'thumbnail' => $thumbnail_name,
            'created_at' => Carbon::now(),
        ]);
    
        return back()->with('added', 'Post added successfully!');
    }

    function my_post(){
        $posts = Post::where('author_id', Auth::guard('author')->id())->simplepaginate(10);
        return view('frontend.author.my_Post',[
            'posts'=>$posts,
        ]);
    }
    function my_post_status($post_id){
        $post = Post:: find($post_id);
        if($post -> status == 1){
            Post::find($post_id)->update([
               'status'=>0,
            ]);
            return back()->with('status_change','Post UnPublished Successfully!');
        }else{
            Post::find($post_id)->update([
               'status'=>1,
            ]);
            return back()->with('status_change','Post published Successfully!');
        }
    }
    function my_post_delete($post_id){
        $post = Post::find($post_id);
        //preview
        $delete_from = public_path('uploads/post/preview/'. $post->preview);
        unlink($delete_from);
        //thumbnail
        $delete_from2 = public_path('uploads/post/thumbnail/'. $post->thumbnail);
        unlink($delete_from2);

        Post::find($post_id)->delete();
        return back()->with('del','Post Deleted Successfully!');
    }
}

