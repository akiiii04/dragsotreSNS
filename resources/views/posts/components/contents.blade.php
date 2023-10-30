<div class="contents">
    <div class="content">
        <div class="likes">
                @if($post->is_liked_by_auth_user())
                    <a href="/unlike/{{$post->id}}" class="like">
                        <span class="heart">&hearts;</span>
                        <span class="hovered">&#9825;</span>
                        <span class="count">{{ $post->likes->count() }}</span>
                    </a>
                @else
                    <a href="/like/{{$post->id}}" class="unlike">
                        <span class="heart">&#9825;</span>
                        <span class="count">{{ $post->likes->count() }}</span>
                    </a>
                @endif
            </div>
        <div class='comment'>
            <img src="{{ asset('images/balloon.svg') }}" class="balloon">{{ $post->childposts->count() }}
        </div>
        @if(isset($is_List))
            @if($post->unsolved==1)
                <div class='unsolved'>
                    未解決
                </div>
            @endif
        @else
            <a class="create_reply" href='/posts/{{$post->id}}/create/'>返信する</a>
        @endif
    </div>
    <div class='user_time'>
        <div class='user'>
                <span class="contributor">投稿者:</span>
                @if($post->user_id==Auth::user()->id)
                    <a class='name' href='../../profile/{{$post->user_id}}/1'>自分</a>
                @endif
                @if($post->anonymity!=0&&$post->user_id!=Auth::user()->id)
                    <a class='name'>{{ $post->display_name() }}</a>
                @endif
                @if($post->anonymity!=0&&$post->user_id==Auth::user()->id)
                    <span class='anonymous'>(匿名)</span>
                @endif
                @if($post->anonymity==0&&$post->user_id!=Auth::user()->id)
                    <a class='name' href='../../profile/{{$post->user_id}}/1'>{{ $post->user->name }}</a>
                @endif
            </div>
        <div class='time'>
            {{$post->time_difference}}
        </div>
    </div>
</div>