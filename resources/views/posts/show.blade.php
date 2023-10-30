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
                @include('posts.components.mostParent')
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
                <div class="bottom_space"></div>
            </section> 
        </x-app-layout>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="/js/show.js"></script>
    </body>
</html>