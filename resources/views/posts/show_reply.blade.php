<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width">
        @if(!isset($parent))
            <title>削除済みの投稿に対する返信</title>
        @else
            <title>{{ Str::limit($parent->title, 56, '...') }}に対する返信</title>
        @endif
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/show.css" rel="stylesheet">
        
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                @if(!isset($parent))
                    削除済みの投稿に対する返信
                @else
                    {{ Str::limit($parent->title, 56, '...') }}に対する返信
                @endif
            </x-slot>
            <section>
                @if(!isset($parent))
                    <div class="deleted_parent">
                        元の投稿はすでに削除されています
                    </div>
                @else
                    <button id="toggle-button" onclick="toggleContent()">元の投稿を表示</button>
                    <div class="post" id="parent" style="display: none;">
                        @if($parent->unsolved==1)
                            <div class='unsolved'>
                                未解決
                            </div>
                        @endif
                        @if($parent->post_id==NULL)
                            <div class="title"><a href="/posts/{{$parent->id}}">{{ Str::limit($parent->title, 56, '...') }}</a></div>
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
                            <a href="/posts/{{$parent->id}}">{!! nl2br($parent->body) !!}</a>
                        </div>
                        @if($parent->user_id==Auth::user()->id)
                            <div class="edits">
                                <a class="edit" href="/posts/{{ $parent->id }}/edit">編集する</a>
                                <form action="/posts/{{ $parent->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="delete" value="削除する" onclick='return confirm("本当に削除しますか？")'>
                                </form>
                                @if($parent->picture==NULL&&$parent->user_id==Auth::user()->id)
                                    <div class="add"><a href="/picture/{{ $parent->id }}/edit">画像を追加する</a></div>
                                @endif
                            </div>
                        @endif
                        <div class="contents">
                            <div class="content">
                                <div class="likes">
                                    @if($parent->is_liked_by_auth_user())
                                        <a href="/unlike/{{$parent->id}}" class="like">
                                            <span class="heart">&hearts;</span>
                                            <span class="hovered">&#9825;</span>
                                            <span class="count">{{ $parent->likes->count() }}</span>
                                        </a>
                                    @else
                                        <a href="/like/{{$parent->id}}" class="unlike">
                                            <span class="heart">&#9825;</span>
                                            <span class="count">{{ $parent->likes->count() }}</span>
                                        </a>
                                    @endif
                                </div>
                                <div class='comment'>
                                    <img src="{{ asset('images/balloon.svg') }}" class="balloon">{{ $post->childposts->count() }}
                                </div>
                                <a class="create_reply" href='/parents/{{$parent->id}}/create/'>返信する</a>
                            </div>
                            <div class='user_time'>
                                <div class='user'>
                                        <span class="contributor">投稿者:</span>
                                        @if($parent->user_id==Auth::user()->id)
                                            <a class='name' href='../../profile/{{$parent->user_id}}'>自分</a>
                                        @endif
                                        @if($parent->anonymity==1&&$parent->user_id!=Auth::user()->id)
                                            <a class='name'>匿名希望投稿者</a>
                                        @endif
                                        @if($parent->anonymity==1&&$parent->user_id==Auth::user()->id)
                                            <a class='name' href='../../profile/{{$parent->user_id}}'>(匿名)</a>
                                        @endif
                                        @if($parent->anonymity==0&&$parent->user_id!=Auth::user()->id)
                                            <a class='name' href='../../profile/{{$parent->user_id}}'>{{ $parent->user->name }}</a>
                                        @endif
                                    </div>
                                <div class='time'>
                                    {{$parent->time_difference}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="post">
                    <div class="parent_reply">
                        @if(isset($parent))
                            <a class="parent_title" href="/posts/{{$parent->id}}">{{ Str::limit($parent->title, 56, '...') }}</a>
                            <span>に対する返信</span>
                        @endif
                    </div>
                    <div class="body">
                        <p>{{ $post->body }}</p>    
                    </div>
                    @if($post->user_id==Auth::user()->id)
                        <div class="edits">
                            <a class="edit" href="/posts/{{ $post->id }}/edit">編集する</a>
                            <form action="/posts/{{ $post->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="delete" value="削除する" onclick='return confirm("本当に削除しますか？")'>
                            </form>
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
                    @if ($post->childPosts->count() > 0)
                        @foreach ($replies as $childPost)
                            @if ($childPost->childPosts->count() > 0 || !($childPost->deleted_at))
                            <script>
                                var noCommentElement = document.querySelector(".noComment");
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