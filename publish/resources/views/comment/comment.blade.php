<ul id="comment_delete_{!! $comment->id !!}" style="overflow: hidden; border-bottom: 1px solid #DDDDDD">
        <div class="commenterImage">
            @if(!empty($comment->getUser()->preview))
                <img src="/{!! $comment->getUser()->preview !!}">
            @else
                <img src="/public/img/default.jpg">
            @endif
        </div>

        <div class="commentText">
            <small style="color: #A0A0A0;">{!! $comment->created_at->format('j F Y G:i') !!}</small>
            <a href="/profile/{!! $comment->getUser()->id !!}">
            <br><span style="font-size: 14px; color: #717171"><i class="fa fa-at"></i>{!! $comment->getUser()->nickname !!}</span></a>
            <p style="margin: 20px auto 20px;">{!!$comment->comment !!}</p>
            @if(($comment->user_id == Auth::id()) || ($twit->user_id == Auth::id()))
                <a style="float:right;" class="comment_delete" data-parameter="{!! $comment->id !!}"><small>Delete</small></a>
            @endif
            <a id="comment_like_{!! $comment->id !!}" class="@if(!$comment->hasUserLike(Auth::user())) comment_like @endif" data-parameter="{!! $comment->id !!}"><small>
                    <span id="comment_like_icon_{!! $comment->id !!}" class="@if($comment->hasUserLike(Auth::user())) fa-thumbs-up @else fa-thumbs-o-up @endif fa"></span>
                    <span id="comment_like_count_{!! $comment->id !!}">{!! $comment->getCountLikes()!!}</span></small></a>
            <span class="reply" data-user="{!! $comment->getUser()->nickname !!}" data-parameter="{!! $twit->id !!}">{!! Html::image('/icon/reply.png', 'reply', ['width' => 20, 'height' => 20]) !!}</span>
        </div>
</ul>