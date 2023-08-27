<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Post_Tag;

use App\Http\Requests\PostRequest;
use Auth;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post, $type, Request $request)
    {
        $search = $request->input('search');
        
        if($search){
             return view('posts.index')->with(['posts' => $post->getSearchPost($type,$search)])->with(['search' => $search])->with(['type' => $type]);
        }

        else
        return view('posts.index')->with(['posts' => $post->getPost($type)])->with(['type' => $type]);
    }
    
    public function create($type)
    {
        return view('posts.create')->with(['type' => $type]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
         if($request->file('picture')){
            $image_url = Cloudinary::upload($request->file('picture')->getRealPath())->getSecurePath();
            $input_post += ['picture' => $image_url];
         }

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
        ->with(['replies' => $post->getReply()])->with(['source' => $post->getSource()]);
    }
    
    public function edit(Post $post)
    {
        
        if($post->user_id==Auth::id()){
            $tag_input="";
            $tags=Post_Tag::where("post_id", $post->id)->get();
            foreach($tags as $tag)
            {
                $tag_name=Tag::where("id", $tag->tag_id)->first();
                $tag_input.="#".$tag_name->name;
            }
            return view('posts.edit')->with(['post' => $post])->with(['tag' => $tag_input]);
        }

    }
    public function edit_picture(Post $post)
    {   
        if($post->user_id==Auth::id())
        return view('posts.edit_picture')->with(['post' => $post]);
    }
     public function update_picture(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        if($request->file('picture')){
            $image_url = Cloudinary::upload($request->file('picture')->getRealPath())->getSecurePath();
            $input_post += ['picture' => $image_url];
        }
        else $input_post += ['picture' => NULL];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        $tag_old=Post_Tag::where('post_id', $post->id)->delete(); //元々あったタグを削除
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
        public function reply(Post $post)
    {
        return view('posts.create_reply')->with(['post' => $post]);
    }
    
}
