<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
           {{ Str::limit($post->title, 56, '...') }}に返信する
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/create.css" rel="stylesheet">
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            @if($post->post_id==NULL)
                <div class="title">{{ Str::limit($post->title, 56, '...') }}に返信する</div>
            @else
                <div class="title">{{ Str::limit($post->body, 56, '...') }}に返信する</div>
            @endif
        </x-slot>
            <section>
                <form action="/posts/" method="POST">
                    @csrf
                    <div class="body">
                        <textarea class="input" name="post[body]" placeholder="返信を記入">{{ old('post.body') }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    </div>
                    <div class="checkbox">
                        <div class="anonymity">
                            <input type="hidden" name="post[anonymity]" value=0>
                            @if(old('post.anonymity')==1)
                                <input type="checkbox" checked name="post[anonymity]" value=1>匿名にする
                            @else
                                <input type="checkbox" name="post[anonymity]" value=1>匿名にする
                            @endif
                        </div>
                    </div>
                    
                    <input type="hidden" name="post[title]" value=0>
                    <input type="hidden" name="post[unsolved]" value=0>
                    <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
                    <input type="hidden" name="post[type_id]" value={{ $post->type_id }}>
                    <input type="hidden" name="post[post_id]" value={{ $post->id }}>
                    <input class="submit" type="submit" value="保存"/>
                </form>
            </section>
    </body>
    </x-app-layout>
        
</html>