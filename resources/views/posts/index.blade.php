<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>ドラッグストアSNS</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  @if ($type==1)業務中に困ったこと 投稿一覧@endif
        　  @if ($type==2)業務情報 投稿一覧@endif
             </x-slot>
             <a class='text-2xl' href='/{{$type}}/create/'>投稿する</a>
            @foreach ($posts as $post)
                <div class='posts'>
                    <a class='text-2xl' href='../../posts/{{$post->id}}'>{{$post->title}}</a>
                </div>
                <div class='user'>
                    投稿者　
                    @if($post->anonymity==1)<a class='text-2xl'>匿名希望投稿者</a>
                    @else<a class='text-2xl' href='../../profile/{{$post->user_id}}'>{{ $post->user->name }}</a> @endif
                </div>
                @foreach($post->tags as $tag)
                    {{ $tag->name }}
                @endforeach
            @endforeach
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            
        </x-app-layout>
        
    </body>
</html>