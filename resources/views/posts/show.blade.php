<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script>
            function like(post) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/like/${post}`,
    type: "POST",
  })
    .done(function (data, status, xhr) {
      console.log(data);
    })
    .fail(function (xhr, status, error) {
      console.log();
    });
}
        </script>
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  {{ $post->title }}
             </x-slot>
        <h1 class="title">
            {{ $post->title }}
        </h1>
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
                <a class='text-2xl' href='../../posts/{{$reply->id}}'>{{ $reply->body }}</a>
            </div>
            <div class='user'>
                投稿者　
                @if($reply->anonymity==1)<a class='text-2xl'>匿名希望投稿者</a>
                @else<a class='text-2xl' href='../../profile/{{$reply->user_id}}'>{{ $reply->user->name }}</a> @endif
            </div>
        @endforeach
        <button onclick="like({{$post->id}})">いいね</button>
        <script src="like.js"></script>
        </x-app-layout>
       
    </body>
</html>