<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>ドラッグストアSNS</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/top.css" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            <x-slot name="header">
        　  トップページ
             </x-slot>
             <section>
                <h1 class="head1">ドラッグストア従業員用SNSをご利用いただきありがとうございます！</h1>
                <div class="p1">このサイトは、覚えなければならないことが多いドラッグストア従業員たちの悩みを解決するために作られました。<br><br>
                    特に入ったばかりの従業員たちは分からないことだらけだと思うので、ぜひこのサイトを活用してください！！</div>
                <h1 class="head1">このサイトの使い方</h1>
                <div class="p2">このサイトでは<span>「困ったこと」</span>と<span>「役立つ情報」</span>という2種類の投稿スペースを用意しました。<br><br>
                    <span>「困ったこと」</span>では、業務をしているときにこういうことで困った、今もどう対応すればよかったかわからない、といった悩みを投稿できます。<br>
                    すでに解決方法を教わった内容でも、それを知らない誰かのために投稿していただけるとありがたいです。<br>
                    さらに、匿名機能を実装しているので、「こんな簡単なことを投稿するのも...」というような内容でも気軽に投稿してください！<br><br>
                    <span>「役立つ情報」</span>には、商品の情報やお客様からの様々な要望に対する対応方法を投稿できます。<br>
                    「困ったこと」に投稿された内容を参考に、困っている人が多い内容を投稿するのもありです。<br><br><br>
                    注意：多くの従業員が閲覧しますので、個人情報は書き込まないようにしてください
                </div>
             </section>
            
        </x-app-layout>
        
    </body>
</html>