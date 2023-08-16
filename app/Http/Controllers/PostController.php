<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post, $type)
    {
        return view('posts.index')->with(['posts' => $post->getByLimit($type)])->with(['type' => $type]);
    }
    
    public function create($type)
    {
        return view('posts.create')->with(['type' => $type]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag_name, $match); //#表記されたタグを配列に格納
        foreach($match[1] as $input_tag)
        {
	        $tag=Tag::firstOrCreate(['name'=>$input_tag]);//tagテーブルにないときは新しくtagを作成
	        $tag=null;
            $tag_id=Tag::where('name',$input_tag)->get(['id']);
            $post->tags()->attach($tag_id);
        }
        return redirect('/posts/' . $post->id);
    }
    
    public function show(Post $post)
    {
        if($post->post_id==NULL) 
        return view('posts.show')->with(['post' => $post])
        ->with(['replies' => $post->getReply()]);
        
        else 
        return view('posts.show_reply')->with(['post' => $post])
        ->with(['replies' => $post->getReply()])->with(['source' => $post->find($post->id)]);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
        public function reply(Post $post)
    {
        return view('posts.create_reply')->with(['post' => $post]);
    }
    
}
