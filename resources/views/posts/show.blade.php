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
                    <div class="title">
                        {{ $post->title }}
                    </div>
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
                        {!! nl2br($post->body) !!}
                    </div>
                    @if($post->user_id==Auth::user()->id)
                        <div class="edits">
                            <a class="edit" href="/posts/{{ $post->id }}/edit">編集する</a>
                            <form action="/posts/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="delete" value="削除する" onclick='return confirm("本当に削除しますか？")'>
                            </form>
                            @if($post->picture==NULL&&$post->user_id==Auth::user()->id)
                                <div class="add"><a href="/picture/{{ $post->id }}/edit">画像を追加する</a></div>
                            @endif
                        </div>
                    @endif
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
                <div class='ALLreplies'>この投稿への返信
                    <div class="noComment">この投稿にはまだ返信がありません</div>
                    <!-- 削除済の投稿を含めてカウント-->
                    @if ($post->childPosts->count() > 0)
                        @foreach ($replies as $childPost)
                            @if ($childPost->childPosts->count() > 0 || !($childPost->deleted_at))
                            <script>//返信が一つでも表示されればnoCommentを非表示に
                                let noCommentElement = document.querySelector(".noComment");
                                if (noCommentElement) {
                                    noCommentElement.style.display = "none";
                                }
                            </script>
                                <div class="replies">@include('posts.child_post', ['post' => $childPost, 'parent' => $post->id])</div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </section> 
        </x-app-layout>
       <script type="text/javascript" src="/js/show.js"></script>
    </body>
</html>