<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
    $tags=Tag::all();
    $categories=Category::all();
    $posts=Post::where('status',1)->paginate(3);
    $sliders=Post::where('status',1)->latest()->take(3)->get();
   return view('frontend.index', [
    'categories'=>$categories,
    'tags'=>$tags,
    'posts'=>$posts,
    'sliders'=>$sliders,
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
        return view('frontend.post_details',[
            'post'=>$post,
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
            })->get();

            return view('frontend.search',[
                'search_posts'=>$search_posts,
            ]);
        }

}
