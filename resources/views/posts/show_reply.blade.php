<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width">
        <title>ドラッグストアSNS</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/show.css" rel="stylesheet">
        
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
                @if($post->parentpost->post_id)
                    {{ Str::limit($post->parentpost->body, 56, '...') }}に対する返信
                @else
                    {{ Str::limit($post->parentpost->title, 56, '...') }}に対する返信
                @endif
            </x-slot>
            @if (session('flash_message'))
                <div class="flash_message">
                    {{ session('flash_message') }}
                </div>
            @endif
            <section>
                <button id="toggle-button" onclick="toggleContent()">元の投稿を表示</button>
                <div class="posts" id="parent" style="display: none;">
                        @foreach($post->getParentList() as $parentpost)
                            @if($parentpost->post_id==NULL)@include('posts.components.mostParent', ['post' => $parentpost], ['is_reply_page' => 1])
                            @else
                                <div class='line'></div>
                                @include('posts.components.reply', ['post' => $parentpost])
                            @endif
                        @endforeach
                </div>
                <div class="post">
                    <div class="parent_reply">
                        @if($post->parentpost->post_id)
                            <a class="parent_title" href="/posts/{{$post->parentpost->id}}">{{ Str::limit($post->parentpost->body, 56, '...') }}</a>
                            <span>に対する返信</span>
                        @else
                            <a class="parent_title" href="/posts/{{$post->parentpost->id}}">{{ Str::limit($post->parentpost->title, 56, '...') }}</a>
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
                    @include('posts.components.contents')
                </div>
                <div class='ALLreplies'>この投稿への返信
                    <div class="noComment">この投稿にはまだ返信がありません</div>
                    <!-- 削除済の投稿を含めてカウント-->
                    @if ($post->childPosts->count() > 0)
                        @foreach ($post->getReplies() as $childPost)
                            @if ($childPost->showable_reply(5))
                            <script>//返信が一つでも表示されればnoCommentを非表示に
                                let noCommentElement = document.querySelector(".noComment");
                                if (noCommentElement) {
                                    noCommentElement.style.display = "none";
                                }
                            </script>
                                <div class="replies">
                                    @include('posts.components.child_post', ['post' => $childPost, 'childPost' => $childPost->getReply() ,'first' => $post->id, 'depth' => 4])
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </section>
            
        </x-app-layout>
        <script src="https://code.jquery.com/jquery.min.js"></script>
       <script type="text/javascript" src="/js/show.js"></script>
    </body>
</html>