<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @if($parent->post_id==NULL)
                <div class="title">{{ Str::limit($parent->title, 56, '...') }}への返信を編集する</div>
            @else
                <div class="title">{{ Str::limit($parent->body, 56, '...') }}への返信を編集する</div>
            @endif
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/create.css" rel="stylesheet">
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            @if($parent->post_id==NULL)
                <div class="title">{{ Str::limit($parent->title, 56, '...') }}への返信を編集する</div>
            @else
                <div class="title">{{ Str::limit($parent->body, 56, '...') }}への返信を編集する</div>
            @endif
        </x-slot>
            <section>
                <form action="/posts/{{ $post->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="body">
                        <textarea class="input" name="post[body]" placeholder="返信を記入">{{ old('post.body', $post->body) }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    </div>
                    <div class="checkbox">
                        <div class="anonymity">
                            <input type="hidden" name="post[anonymity]" value=0>
                            @if($post->anonymity!=0)
                            <input type="checkbox" checked="checked" name="post[anonymity]" value=1>匿名にする
                            @else
                            <input type="checkbox" name="post[anonymity]" value=1>匿名にする
                            @endif
                        </div>
                    </div>
                    
                    
                    <input type="hidden" name="post[title]" value={{$post->title}}>
                    <input type="hidden" name="post[unsolved]" value=0>
                    <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
                    <input type="hidden" name="post[type_id]" value={{ $post->type_id }}>
                    <input class="submit" type="submit" value="保存"/>
                </form>
            </section>
        
    </body>
    </x-app-layout>
        
</html>