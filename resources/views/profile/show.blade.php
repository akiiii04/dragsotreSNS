<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $user->name }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/index.css" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  {{ $user->name }}
             </x-slot>
             <section>
                <div class="user_info">
                    <h1 class="name">
                        {{ $user->name }}
                    </h1>
                    <div class="affiliation">
                        <div></div>
                        <p>所属: {{ $user->affiliation }}</p>    
                    </div>
                    <div class="position">
                        <div></div>
                        <p>役職: {{ $user->position }}</p>    
                    </div>
                </div>
                <br>
                <div class="who_list">{{$user->name}}の投稿一覧</div>
                <div class="type">
                    @if($type==1)
                    <div class="trouble_now">困ったこと</div>
                    <a class="info" href='/profile/{{$user->id}}/2'>役立つ情報</a>
                    @else
                    <a class="trouble" href='/profile/{{$user->id}}/1'>困ったこと</a>
                    <div class="info_now" >役立つ情報</div>
                    @endif
                </div>
                @include('posts.components.postList')
             </section>
        

        </x-app-layout>
       
    </body>
</html>