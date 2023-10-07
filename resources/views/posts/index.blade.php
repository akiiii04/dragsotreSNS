<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>ドラッグストアSNS</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/index.css" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
            　  @if ($type==1)困ったこと 投稿一覧@endif
            　  @if ($type==2)役立つ情報 投稿一覧@endif
             </x-slot>
                <section>
                    <div class="posting">
                        <a class='link' href='/{{$type}}/create/'>投稿する</a>
                    </div>
                    
                 <form method="GET" action="/{{$type}}/index">
                    <div class="search">
                            <input class="input" type="search" placeholder="キーワードを入力" name="search" value="@if(isset($search)){{ $search }}@endif">
                            <button class="submit" type="submit">検索</button>
                    </div>
                    
                </form>
                <div class='paginate'>
                        @if(isset($search)){{ $posts->appends(['search' => $search])->links('vendor.pagination.tailwind') }}
                        @else{{ $posts->links('vendor.pagination.tailwind') }}@endif
                    </div>
                @foreach ($posts as $post)
                    <div class='post'>
                        <a class='title' href='../../posts/{{$post->id}}'>{{ Str::limit($post->title, 54, '...') }}</a>
                        <div class='body'>
                            {{ $post->body }}
                        </div>
                        <div class='tags'>
                            @foreach($post->tags as $tag)
                                <div class='tag'>{{ $tag->name }}</div>
                            @endforeach
                        </div>
                        <div class="contents">
                            <div class='content'>
                                    <div class="likes">
                                        @if($post->is_liked_by_auth_user())
                                            <a href="/unlike/{{$post->id}}" class="like">
                                                <span class="heart">&hearts;</span>
                                                <span class="hovered">&#9825;</span>
                                                <span class="count">{{ $post->likes->count() }}</span>
                                            </a>
                                        @else
                                            <a href="/like/{{$post->id}}" class="unlike">
                                                <span class="heart">&#9825;</span>
                                                <span class="count">{{ $post->likes->count() }}</span>
                                            </a>
                                        @endif
                                </div>
                                <div class='comment'>
                                    <img src="{{ asset('images/balloon.svg') }}" class="balloon">{{ $post->childposts->count() }}
                                </div>
                                @if($post->unsolved==1)
                                    <div class='unsolved'>
                                        未解決
                                    </div>
                                @endif
                            </div>
                            <div class='user_time'>
                                <div class='user'>
                                    <span class="contributor">投稿者:</span>
                                    @if($post->user_id==Auth::user()->id)
                                        <a class='name' href='../../profile/{{$post->user_id}}'>自分</a>
                                    @endif
                                    @if($post->anonymity==1&&$post->user_id!=Auth::user()->id)
                                        <a class='name'>匿名希望投稿者</a>
                                    @endif
                                    @if($post->anonymity==1&&$post->user_id==Auth::user()->id)
                                        <a class='name' href='../../profile/{{$post->user_id}}'>(匿名)</a>
                                    @endif
                                    @if($post->anonymity==0&&$post->user_id!=Auth::user()->id)
                                        <a class='name' href='../../profile/{{$post->user_id}}'>{{ $post->user->name }}</a>
                                    @endif
                                </div>
                                <div class='time'>
                                    {{$post->time_difference}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class='paginate'>
                        @if(isset($search)){{ $posts->appends(['search' => $search])->links('vendor.pagination.tailwind') }}
                        @else{{ $posts->links('vendor.pagination.tailwind') }}@endif
                    </div>
                </section>
        </x-app-layout>
        
    </body>
</html>