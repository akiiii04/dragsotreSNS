<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $user->name }}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/profile.css" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  {{ $user->name }}
             </x-slot>
             <section>
                <h1 class="title">
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
             </section>
        

        </x-app-layout>
       
    </body>
</html>