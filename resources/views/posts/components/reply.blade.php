<div class='reply'>
    @if($post->deleted_at)
        <div class="deleted">
            この投稿は削除されました
        </div>
    @else
        <a class='body' href='../../posts/{{$post->id}}'>{{ $post->body }}</a>
        @include('posts.components.contents')
    @endif
</div>