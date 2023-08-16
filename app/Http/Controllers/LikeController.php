<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
        public function store($post)
    {
        Auth::user()->like($post);
        return 'ok!'; //レスポンス内容
    }

    public function destroy($post)
    {
        Auth::user()->unlike($post);
        return 'ok!'; //レスポンス内容
    }
}
