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
        　  {{ $post->title }}
             </x-slot>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        @if($post->picture)
            <div>
                <img src="{{ $post->picture }}" width="200" alt="画像が読み込めません。"/>
            </div>
        @endif
        @if($post->picture&&$post->user_id==Auth::user()->id)
            <div>
                <a href="/picture/{{ $post->id }}/edit">画像を変更する</a>
            </div>
        @endif
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
            @if($post->user_id==Auth::user()->id)
                <div class="edit"><a href="/posts/{{ $post->id }}/edit">編集する</a></div>
            @endif
            @if($post->picture==NULL&&$post->user_id==Auth::user()->id)
            <div>
                <a href="/picture/{{ $post->id }}/edit">画像を追加する</a>
            </div>
        @endif
        </div>
        <a class='text-2xl' href='/posts/{{$post->id}}/create/'>コメントする</a>
        <div class='reply'>この投稿へのコメント</div>
        @foreach ($replies as $reply)
            <div class='posts'>
                <a class='text-2xl' href='../../posts/{{$reply->id}}'>{{ $reply->body }}</a>
            </div>
            <div class='user'>
                投稿者　
                @if($reply->anonymity==1)<a class='text-2xl'>匿名希望投稿者</a>
                @else<a class='text-2xl' href='../../profile/{{$reply->user_id}}'>{{ $reply->user->name }}</a> @endif
            </div>
        @endforeach
        <div>
            @if($post->is_liked_by_auth_user())
                <a href="/unlike/{{$post->id}}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
            @else
                <a href="/like/{{$post->id}}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
            @endif
        </div>
        </x-app-layout>
       
    </body>
</html>