<div class="actionBox">
    @foreach($twit->getComments() as $comment)
       @include('comment.comment')
    @endforeach
    <div id="actionBox_{!! $twit->id !!}"></div>
    <div class="form-inline">
        <div class="form-group" style="width: 74%;">
            <input id="comment_{!! $twit->id !!}" class=" form-control" name="comment" style="width:  -webkit-fill-available;" type="text" placeholder="Your comments" />
        </div>
        <div class="form-group">
            <a  data-parameter="{!! $twit->id !!}" class=" comment-btn btn btn-default">Comment <img src="/icon/comment.png" width="20" height="20" style="margin-left: 5px;"></a>
        </div>
    </div>
</div>