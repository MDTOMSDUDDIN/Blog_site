<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
    $tags=Tag::all();
    $categories=Category::all();
    $posts=Post::where('status',1)->get();
   return view('frontend.index', [
    'categories'=>$categories,
    'tags'=>$tags,
    'posts'=>$posts,
   ]);
 }
    function author_login_page(){
        return view('frontend.author.login');
    }
    function author_register_page(){
        return view('frontend.author.register');
    }
}
