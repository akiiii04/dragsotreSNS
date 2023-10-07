<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            {{ Str::limit($post->title, 56, '...') }}を編集する
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/create.css" rel="stylesheet">
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            <div class="edit">{{ Str::limit($post->title, 56, '...') }}を編集する</div>
        </x-slot>
            <section>
                <button type="button" onclick="history.back()">編集をやめる</button>
                <form action="/posts/{{ $post->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="title">
                        <h2>タイトル</h2>
                        <input class="input" type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title', $post->title) }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                    </div>
                    <div class="body">
                        <h2>本文</h2>
                        <textarea class="input" name="post[body]" placeholder="本文。">{{ old('post.body', $post->body) }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    </div>
                    <div class="tag">
                        <h2>タグ</h2>
                        <input class="input" type="text" name="tag_name" placeholder="タグ" value="{{ old('tag_name', $tag) }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('tag.name') }}</p>
                        <p class="ex">例：#お客様質問#目薬#ヘルスケア</p>
                    </div>
                    <div class="checkbox">
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
                    </div>
                    <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
                    <input type="hidden" name="post[type_id]" value={{ $post->type_id }}>
                    <input class="submit" type="submit" value="保存"/>
                </form>
            </section>
        
    </body>
    </x-app-layout>
        
</html>