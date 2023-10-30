<div class="post">
    @if($post->unsolved==1)
        <div class='unsolved'>
            未解決
        </div>
    @endif
    @if(isset($is_reply_page))
        <a class="title" href='../../posts/{{$post->id}}'><br>
            {{ $post->title }}
        </a>
    @else
        <div class="title">
            {{ $post->title }}
        </div>
    @endif
    
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
    @include('posts.components.contents')
</div>