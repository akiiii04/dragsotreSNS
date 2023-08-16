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
        <form action="/posts" method="POST">
            @csrf

            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="anonymity">
                <input type="hidden" name="post[anonymity]" value=0>
                <input type="checkbox" checked="checked" name="post[anonymity]" value=1>匿名にする
            </div>
            <input type="hidden" name="post[title]" value=0>
            <input type="hidden" name="post[unsolved]" value=0>
            <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
            <input type="hidden" name="post[type_id]" value={{ $post->type_id }}>
            <input type="hidden" name="post[post_id]" value={{ $post->id }}>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
    </x-app-layout>
        
</html>