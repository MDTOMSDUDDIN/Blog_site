<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\ViewPost;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function index(){
    $tags=Tag::all();
    $categories=Category::all();
    $posts=Post::where('status',1)->paginate(3);
    $sliders=Post::where('status',1)->latest()->take(3)->get();

    $View_Posts=ViewPost::where('total_read','>=',5)->get();

   return view('frontend.index', [
    'categories'=>$categories,
    'tags'=>$tags,
    'posts'=>$posts,
    'sliders'=>$sliders,
    'View_Posts'=>$View_Posts,
   ]);
 }
    function author_login_page(){
        return view('frontend.author.login');
    }
    function author_register_page(){
        return view('frontend.author.register');
    }
    
    function post_details($slug){
        $post=Post::where('slug' , $slug)->first();

        if (ViewPost::where('post_id', $post->id)->exists()) {
            ViewPost::where('post_id', $post->id)->increment('total_read', 1);
        } else {
            ViewPost::insert([
                'post_id' => $post->id,
                'total_read' => 1,
            ]);
        }

        $comments= Comment::where('post_id', $post->id)->get();
        return view('frontend.post_details',[
            'post'=>$post,
            'comments'=>$comments,
        ]);
    }

    function author_post($author_id){
        $author=Author::find($author_id);
        $posts=Post::where('author_id',$author_id)->where('status', 1)->get();
        return view('frontend.author_post',[
            'author'=>$author,
            'posts'=>$posts,
        ]);
    }
    function category_post($category_id){
        $category=Category::find($category_id);
        $posts=Post::where('category_id', $category_id)->get();
        return view('frontend.category_post',[
            'category'=>$category,
            'posts'=>$posts,
        ]);
    }

        function search(Request $request){
            $data=$request->all();
            $search_posts=POST::where(function($q) use ($data){
                if(!empty($data['q']) && $data['q'] !='' && $data['q'] !='undefine'){
                    $q->where( function($q) use ($data){
                        $q->where('title', 'like' , '%' . $data['q'] . '%' );
                        $q->orWhere('desp', 'like' , '%' . $data['q'] . '%' );
                    });
                }
            })->paginate(2);
             $tags=Tag::all();
             $categories=Category::all();
             $View_Posts=ViewPost::where('total_read','>=',5)->get();

            return view('frontend.search',[
                'search_posts'=>$search_posts,
                'tags'=>$tags,
                'categories'=>$categories,
                'View_Posts'=>$View_Posts,
            ]);
        }

//tag_post section 
        function tag_post($tag_id){
            $all ="";  
            foreach(Post::all() as $post){
                $after_explode=explode(',', $post->tags);
                 if(in_array($tag_id, $after_explode)){
                    $all .=$post->id.',';
                 }
            }
           $explode2=explode(',',$all);
           $tag_post=Post::find($explode2);
           $tag=Tag::find($tag_id);
            return view('frontend.tag_post',[
                'tag_post'=>$tag_post,
                'tag'=>$tag,
            ]);
        }
//-------------------------comments section --------------------------------

        function comment_store(Request $request){
            Comment::insert([
                'author_id'=>Auth::guard('author')->id(),
                'post_id'=>$request->post_id,
                'comments'=>$request->comments,
                'created_at'=>Carbon::now(),
            ]);
            return back();
        }

}
