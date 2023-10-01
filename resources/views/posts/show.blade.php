<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $post->title }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/show.css" rel="stylesheet">
        
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  {{ $post->title }}
            </x-slot>
            <section>
                <div class="post">
                    @if($post->unsolved==1)
                        <div class='unsolved'>
                            未解決
                        </div>
                    @endif
                    <h1 class="title">
                        {{ $post->title }}
                    </h1>
                    <div class='tags'>
                        @foreach($post->tags as $tag)
                            <div class='tag'>{{ $tag->name }}</div>
                        @endforeach
                    </div>
                    <div class="pictures">
                        @if($post->picture)
                            <img class="picture" src="{{ $post->picture }}" alt="画像が読み込めません。"/>
                        @endif
                        @if($post->picture&&$post->user_id==Auth::user()->id)
                            <div>
                                <a class="change" href="/picture/{{ $post->id }}/edit">画像を変更する</a>
                            </div>
                        @endif
                    </div>
                    <div class="body">
                        <p>{!! nl2br($post->body) !!}</p>    
                    </div>
                    @if($post->user_id==Auth::user()->id)
                        <div class="edits">
                            <a class="edit" href="/posts/{{ $post->id }}/edit">編集する</a>
                            <form action="/posts/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class"delete" value="削除する"/>
                            </form>
                            @if($post->picture==NULL&&$post->user_id==Auth::user()->id)
                                <div class="add"><a href="/picture/{{ $post->id }}/edit">画像を追加する</a></div>
                            @endif
                        </div>
                    @endif
                    <div class="contents">
                        <div class="content">
                            @if($post->type_id==1)
                                <div class="votes">
                                    <span class="badge">{{ $post->likes->count() }}票</span>
                                    @if($post->is_liked_by_auth_user())
                                        <a href="/unlike/{{$post->id}}" class="like">
                                            　投票をやめる
                                            <span class="tooltip-text">自分も同じようなことで困ったことがある</span>
                                        </a>
                                    @else
                                        <a href="/like/{{$post->id}}" class="like">
                                            　投票をする
                                            <span class="tooltip-text">自分も同じようなことで困ったことがある</span>
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="likes">
                                    @if($post->is_liked_by_auth_user())
                                        <a href="/unlike/{{$post->id}}" class="btn btn-success btn-sm">
                                            <span style="color:#FF00CC">&hearts;</span>
                                            <span class="badge">{{ $post->likes->count() }}</span>
                                        </a>
                                    @else
                                        <a href="/like/{{$post->id}}" class="btn btn-secondary btn-sm">
                                            &#9825;
                                            <span class="badge">{{ $post->likes->count() }}</span>
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <div class='comment'>
                                {{ $post->childposts->count() }}コメント
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
                <div class='ALLreplies'>この投稿へのコメント
                    @if ($post->childPosts->count() > 0)
                        @foreach ($replies as $childPost)
                           <div class="replies">@include('posts.child_post', ['post' => $childPost, 'parent' => $post->id])</div>
                        @endforeach
                    @endif
                </div>
            </section> 
        

        </x-app-layout>
       
    </body>
</html>