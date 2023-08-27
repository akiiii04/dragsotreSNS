<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            画像の変更
        </x-slot>
        <h1>Blog Name</h1>
        <form action="/picture/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="image">
                <input type="file" name="picture">
            </div>
            <input type="hidden" name="post[title]" value={{ $post->title }}>
            <input type="hidden" name="post[body]" value={{ $post->body }}>

            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
    </x-app-layout>
        
</html>