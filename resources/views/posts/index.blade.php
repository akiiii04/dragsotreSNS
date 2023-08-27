<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>ドラッグストアSNS</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/index.css" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  @if ($type==1)業務中に困ったこと 投稿一覧@endif
        　  @if ($type==2)業務情報 投稿一覧@endif
             </x-slot>
             <a class='text-2xl' href='/{{$type}}/create/'>投稿する</a>
             <form method="GET" action="/{{$type}}/index">
                <input type="search" placeholder="キーワードを入力" name="search" value="@if(isset($search)){{ $search }} @endif">

                <div>
                    <button type="submit">検索</button>
                </div>
            </form>
            @foreach ($posts as $post)
                <div class='post'>
                    <a class='text-2xl' href='../../posts/{{$post->id}}'>{{$post->title}}</a>
                    <div class='user'>
                        投稿者　
                        @if($post->anonymity==1&&$post->user_id!=Auth::user()->id)<a class='text-2xl'>匿名希望投稿者</a>@endif
                        @if($post->anonymity==1&&$post->user_id==Auth::user()->id)
                        <a class='text-2xl' href='../../profile/{{$post->user_id}}'>{{ $post->user->name }}(匿名希望)</a>
                        @endif
                        @if($post->anonymity==0)<a class='text-2xl' href='../../profile/{{$post->user_id}}'>{{ $post->user->name }}</a>@endif
                    </div>
                    @foreach($post->tags as $tag)
                        {{ $tag->name }}
                    @endforeach
                </div>
            @endforeach
                <div class='paginate'>
                    @if(isset($search)){{ $posts->appends(['search' => $search])->links() }}
                    @else{{ $posts->links() }}@endif
                </div>
            
        </x-app-layout>
        
    </body>
</html>