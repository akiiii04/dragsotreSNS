<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            
        </x-slot>
        <h1>Blog Name</h1>
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title', $post->title) }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body', $post->body) }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="tag">
                <h2>タグ</h2>
                <input type="text" name="tag_name" placeholder="タグ" value="{{ old('tag_name', $tag) }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('tag.name') }}</p>
            </div>
            <div class="anonymity">
                <input type="hidden" name="post[anonymity]" value=0>
                @if($post->anonymity==1)
                <input type="checkbox" checked="checked" name="post[anonymity]" value=1>匿名にする
                @else
                <input type="checkbox" name="post[anonymity]" value=1>匿名にする
                @endif
            </div>
            <div class="unsolved">
                <input type="hidden" name="post[unsolved]" value=0>
                @if($post->unsolved==1)
                <input type="checkbox" checked="checked" name="post[unsolved]" value=1>未解決
                @else
                <input type="checkbox" name="post[unsolved]" value=1>未解決
                @endif
            </div>

            <div class="unsolved"></div>
            <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
            <input type="hidden" name="post[type_id]" value={{ $post->type_id }}>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
    </x-app-layout>
        
</html>