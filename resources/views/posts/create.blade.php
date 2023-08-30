<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @if ($type==1)困ったことを投稿する@endif
        　  @if ($type==2)役立つ情報を投稿する@endif
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/create.css" rel="stylesheet">
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            @if ($type==1)困ったことを投稿する@endif
        　  @if ($type==2)役立つ情報を投稿する@endif
        </x-slot>
        <section>
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="title">
                    <h2>タイトル</h2>
                    <input class="input" type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                </div>
                <div class="body">
                    <h2>本文</h2>
                    <textarea class="input" name="post[body]" placeholder="本文">{{ old('post.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="tag">
                    <h2>タグ</h2>
                    <input class="input" type="text" name="tag_name" placeholder="タグ" value="{{ old('tag_name') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('tag_name') }}</p>
                    <p class="ex">例：#お客様質問#目薬#ヘルスケア</p>
                </div>
                <div class="checkbox">
                    <div class="anonymity">
                        <input type="hidden" name="post[anonymity]" value=0>
                        @if($type==1)
                            @if(old('post.anonymity')==1)
                                <input type="checkbox" checked name="post[anonymity]" value=1>匿名にする
                            @else
                                <input type="checkbox" name="post[anonymity]" value=1>匿名にする
                            @endif
                        @endif
                    </div>
                    <div class="unsolved">
                        <input type="hidden" name="post[unsolved]" value=0>
                        @if($type==1)
                             @if(old('post.unsolved')==1)
                                <input type="checkbox" checked name="post[unsolved]" value=1>未解決
                            @else
                                <input type="checkbox" name="post[unsolved]" value=1>未解決
                            @endif
                        @endif
                    </div>
                </div>
                
                <div class="unsolved"></div>
                <div class="image">
                    画像を投稿: <input class"input" type="file" name="picture">
                </div>
                <input type="hidden" name="post[user_id]" value={{ Auth::user()->id }}>
                <input type="hidden" name="post[type_id]" value={{ $type }}>
                <input class="submit" type="submit" value="保存"/>
            </form>
        </section>
        
    </body>
    </x-app-layout>
        
</html>