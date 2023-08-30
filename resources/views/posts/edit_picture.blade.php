<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
             画像の変更
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/create.css" rel="stylesheet">
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            画像の変更
        </x-slot>
        <section>
            <form action="/picture/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="image">
                    画像を変更: <input class"input" type="file" name="picture">
                    <p class="attention">※ファイルを選択しないまま保存した場合、すでにある画像は削除されます</p>
                </div>
                <input type="hidden" name="post[title]" value={{ $post->title }}>
                <input type="hidden" name="post[body]" value={{ $post->body }}>
    
                <input class="submit" type="submit" value="保存"/>
            </form>
        </section>
        
    </body>
    </x-app-layout>
        
</html>