<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function trouble_index(Post $post)
    {
        return view('trouble.index')->with(['posts' => $post->trouble_getByLimit()]);
    }
    
    public function trouble_create(Post $post)
    {
        
    }
    
    public function trouble_store(Post $post)
    {
        
    }
    
    public function trouble_show(Post $post)
    {
        return view('trouble.show')->with(['post' => $post]);
    }
}
