<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $user->name }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  {{ $user->name }}
             </x-slot>
        <h1 class="title">
            {{ $user->name }}
        </h1>
        <div class="affiliation">
            <div>所属</div>
            <p>{{ $user->affiliation }}</p>    
        </div>
        <div class="position">
            <div>役職</div>
            <p>{{ $user->position }}</p>    
        </div>

        </x-app-layout>
       
    </body>
</html>