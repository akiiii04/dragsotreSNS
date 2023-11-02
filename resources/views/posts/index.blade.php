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
                @if (session('flash_message'))
                    <div class="flash_message">
                        {{ session('flash_message') }}
                    </div>
                @endif
                <section>
                    
                    <div class="section">
                        <div class="type">
                            @if($type==1)
                            <div class="trouble_now">困ったこと</div>
                            <a class="info" href='/2/index/'>役立つ情報</a>
                            @else
                            <a class="trouble" href='/1/index/'>困ったこと</a>
                            <div class="info_now" >役立つ情報</div>
                            @endif
                        </div>
                        <div class="posting">
                            <a class='link' href='/{{$type}}/create/'>投稿する</a>
                        </div>
                    </div>
                    <form id="filter-form" method="GET" action="/{{$type}}/index">
                        <div class="search">
                                <input class="input" type="search" placeholder="キーワードを入力" name="search" value="@if(isset($search)){{ $search }}@endif">
                                <button class="submit" type="submit">検索</button>
                        </div>
                        <div class="filter_unsolved">
                            @if(isset($unsolved))<input class="checkbox" checked type="checkbox" name="unsolved">未解決の投稿に限定する
                            @else<input class="checkbox" type="checkbox" name="unsolved" value=1>未解決の投稿に限定する@endif
                        </div>
                    </form>
                    @include('posts.components.postList')
                </section>
        </x-app-layout>
        <script src="https://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="/js/index.js"></script>
    </body>
</html>