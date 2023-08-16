<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
            </x-slot>
        @if($source->post_id==NULL)
            <h1 class="title">
                {{ $source->title }}
            </h1>
        @endif
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $source->body }}</p>    
            </div>

        </div>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
            <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div>
        </div>
        <a class='text-2xl' href='/posts/{{$post->id}}/create/'>コメントする</a>
        <div class='reply'>この投稿へのコメント</div>
        @foreach ($replies as $reply)
            <div class='posts'>
                <a class='text-2xl' href='../../posts/{{$reply->id}}'>{{$reply->body}}</a>
            </div>
            <div class='user'>
                投稿者　
                @if($reply->anonymity==1)<a class='text-2xl'>匿名希望投稿者</a>
                @else<a class='text-2xl' href='../../profile/{{$reply->user_id}}'>{{ $reply->user->name }}</a> @endif
            </div>
            @endforeach
        </x-app-layout>
       
    </body>
</html>