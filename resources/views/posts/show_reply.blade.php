<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ Str::limit($parent->title, 56, '...') }}に対する返信</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/show.css" rel="stylesheet">
        <script>
        function toggleContent() {
            var content = document.getElementById("parent");
            var button = document.getElementById("toggle-button");
            if (content.style.display === "none") {
                content.style.display = "block";
                button.textContent = "元の投稿を非表示";
            } else {
                content.style.display = "none";
                button.textContent = "元の投稿を表示";
            }
        }
        </script>
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                {{ Str::limit($parent->title, 56, '...') }}に対する返信
            </x-slot>
            <section>
                <button id="toggle-button" onclick="toggleContent()">元の投稿を表示</button>
                <div class="post" id="parent" style="display: none;">
                    @if($parent->unsolved==1)
                        <div class='unsolved'>
                            未解決
                        </div>
                    @endif
                    @if($parent->post_id==NULL)
                        <a class="title" href="/posts/{{$parent->id}}">{{ Str::limit($parent->title, 56, '...') }}</a>
                    @endif
                    <div class='tags'>
                        @foreach($parent->tags as $tag)
                            <div class='tag'>{{ $tag->name }}</div>
                        @endforeach
                    </div>
                    <div class="pictures">
                        @if($parent->picture)
                            <img class="picture" src="{{ $parent->picture }}" alt="画像が読み込めません。"/>
                        @endif
                        @if($parent->picture&&$parent->user_id==Auth::user()->id)
                            <div>
                                <a class="change" href="/picture/{{ $parent->id }}/edit">画像を変更する</a>
                            </div>
                        @endif
                    </div>
                    <div class="body">
                        <p>{!! nl2br($parent->body) !!}</p>    
                    </div>
                    @if($parent->user_id==Auth::user()->id)
                        <div class="edits">
                            <a class="edit" href="/posts/{{ $parent->id }}/edit">編集する</a>
                            @if($parent->picture==NULL&&$parent->user_id==Auth::user()->id)
                                <div class="add"><a href="/picture/{{ $parent->id }}/edit">画像を追加する</a></div>
                            @endif
                        </div>
                    @endif
                    <div class="contents">
                        <div class="content">
                            <div class="likes">
                                @if($parent->is_liked_by_auth_user())
                                    <a href="/unlike/{{$parent->id}}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $parent->likes->count() }}</span></a>
                                @else
                                    <a href="/like/{{$parent->id}}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $parent->likes->count() }}</span></a>
                                @endif
                            </div>
                            <div class='comment'>
                                {{ $parent->childposts->count() }}コメント
                            </div>
                            <a class="create_reply" href='/parents/{{$parent->id}}/create/'>返信する</a>
                        </div>
                        <div class='user_time'>
                            <div class='user'>
                                <span class="contributor">投稿者:</span>
                                @if($parent->anonymity==1&&$parent->user_id!=Auth::user()->id)<a class='anonymous'>匿名希望投稿者</a>@endif
                                @if($parent->anonymity==1&&$parent->user_id==Auth::user()->id)
                                <a class='name' href='../../profile/{{$parent->user_id}}'>{{ $parent->user->name }}(匿名)</a>
                                @endif
                                @if($parent->anonymity==0)<a class='name' href='../../profile/{{$parent->user_id}}'>{{ $parent->user->name }}</a>@endif
                            </div>
                            <div class='time'>
                                {{$parent->time_difference}}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="post">
                    <div class="parent_reply">
                            <a class="parent_title" href="/posts/{{$parent->id}}">{{ Str::limit($parent->title, 56, '...') }}</a>
                            <span>に対する返信</span>
                    </div>
                    <div class="body">
                        <p>{{ $post->body }}</p>    
                    </div>
                    @if($post->user_id==Auth::user()->id)
                        <div class="edits">
                            <a class="edit" href="/posts/{{ $post->id }}/edit">編集する</a>
                        </div>
                    @endif
                    <div class="contents">
                        <div class="content">
                            <div class="likes">
                                @if($post->is_liked_by_auth_user())
                                    <a href="/unlike/{{$post->id}}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                                @else
                                    <a href="/like/{{$post->id}}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                                @endif
                            </div>
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
                <div class='ALLreplies'>
                    <div class="post_reply">
                            <a class="post_title">{{ Str::limit($post->body, 56, '...') }}</a>
                            <span>に対する返信</span>
                    </div>
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