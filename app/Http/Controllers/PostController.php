<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function trouble_index(Post $post)
    {
        return view('trouble.index')->with(['posts' => $post])
    }
}
