<div class='paginate'>
    {{$posts->links("vendor.pagination.totalPost")}}
    {{ $posts->appends(request()->query())->links('vendor.pagination.tailwind') }}
</div> 
@foreach ($posts as $post)
    <div class='post'>
        <a class='title' href='../../posts/{{$post->id}}'>{{ Str::limit($post->title, 54, '...') }}</a>
        <div class='body'>
            {{ $post->body }}
        </div>
        <div class='tags'>
            @foreach($post->tags as $tag)
                <div class='tag'>{{ $tag->name }}</div>
            @endforeach
        </div>
        @include('posts.components.contents',['is_List' => 1])
    </div>
@endforeach
<div class='paginate'>
    {{ $posts->appends(request()->query())->links('vendor.pagination.tailwind') }}
</div>