@if(!($first==$post->post_id))<div class='line'></div>@endif
@if(!($first==$post->post_id))<div class='Nofirst'>@endif<!--他にやり方が思いつかず閉じタグに別のifを使用-->
@include('posts.components.reply')
@if(!($first==$post->post_id))</div>@endif
@if ($childPost!=NULL)
    @if ($childPost->showable_reply($depth))
        @include('posts.components.child_post', ['post' => $childPost, 'childPost' => $childPost->getReply() ,'depth' => $depth-1])
    @endif
@endif
