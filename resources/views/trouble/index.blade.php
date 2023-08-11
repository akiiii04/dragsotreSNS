<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>ドラッグストアSNS</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  業務中に困ったこと 投稿一覧
             </x-slot>
            @foreach ($posts as $post)
                <div class='posts'>
                    <a class='text-2xl' href='/trouble/posts/{{$post->id}}'>{{$post->title}}</a>
                </div>
            @endforeach
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            
        </x-app-layout>
        
    </body>
</html>