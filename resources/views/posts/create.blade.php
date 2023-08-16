<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            @if ($type==1)業務中に困ったことを投稿する@endif
        　  @if ($type==2)業務情報を投稿する@endif
        </x-slot>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>本文</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="tag">
                <h2>タグ</h2>
                <input type="text" name="tag_name" placeholder="タグ" value="{{ old('tag_name') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('tag.name') }}</p>
            </div>
            <div class="anonymity">
                <input type="hidden" name="post[anonymity]" value=0>
                <input type="checkbox" checked="checked" name="post[anonymity]" value=1>匿名にする
            </div>
            <div class="unsolved">
                <input type="hidden" name="post[unsolved]" value=0>
                <input type="checkbox" checked="checked" name="post[unsolved]" value=1>未解決
            </div>
            <div class="unsolved"></div>
            <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
            <input type="hidden" name="post[type_id]" value={{ $type }}>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
    </x-app-layout>
        
</html>