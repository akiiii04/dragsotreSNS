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
            @if(!($parent==$post->post_id))<div class='line'></div>@endif
            @if(!($parent==$post->post_id))<div class='Nofirst'>@endif
                <div class='reply'>
                    <a class='body' href='../../posts/{{$post->id}}'>{{ $post->body }}</a>
                    <div class="contents">
                        <div class="content">
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
                            <a class="create_reply" href='/posts/{{$post->id}}/create/'>返信する</a>
                        </div>
                        <div class='user_time'>
                            <div class='user'>
                                <span class="contributor">投稿者:</span>
                                @if($post->anonymity==1&&$post->user_id!=Auth::user()->id)<a class='anonymous'>匿名希望投稿者</a>@endif
                                @if($post->anonymity==1&&$post->user_id==Auth::user()->id)
                                <a class='name' href='../../profile/{{$post->user_id}}'>{{ $post->user->name }}(匿名)</a>
                                @endif
                                @if($post->anonymity==0)<a class='name' href='../../profile/{{$post->user_id}}'>{{ $post->user->name }}</a>@endif
                            </div>
                            <div class='time'>
                                {{$post->time_difference}}
                            </div>
                        </div>
                    </div>
                </div>
            @if(!($parent==$post->post_id))</div>@endif
                @if ($post->childposts->count() > 0)
                        @include('posts.child_post', ['post' => $post->childPosts->first()])
                @endif
    </body>
</html>