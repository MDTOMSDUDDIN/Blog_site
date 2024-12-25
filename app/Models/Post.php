<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    function rel_to_category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    function rel_to_author(){
        return $this->belongsTo(Author::class,'author_id');
    }
}
