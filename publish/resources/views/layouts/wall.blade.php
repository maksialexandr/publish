
@foreach($twits as $twit)
    @if($twit->twit_id)
        <div id="twit_{!! $twit->id !!}" style="cursor: pointer; border: 1px solid #CCCCCC;border-radius: 10px; padding: 10px; margin-bottom: 5px;">
            <div class="row" >
                <div class="col-lg-2">
                    <a href="/profile/{!! $user->id !!}">
                        @if(!empty($user->preview))
                            <img src="/{!! $user->preview !!}" width="75" height="75" class="img-circle">
                        @else
                            <img src="/public/img/default.jpg" width="75" height="75" class="img-circle">
                        @endif
                    </a>
                    <span style="margin: auto 25%; color: #9e9e9e;">{!! $user->getStatus() !!}</span>
                </div>
                <div class="col-lg-10" >
                    <p style="padding-left: 15px;"><small style="float: left;">
                            <a href="/profile/{!! $twit->user->id !!}">{!! $user->name !!}</a><br>{!! $twit->getDate() !!}
                        </small><small style="float: right;">
                            @if ($user == Auth::user())
                                <a class="twit_remove" data-parameter="{!! $twit->id !!}" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove">
                                    <i class="fa fa-remove"></i>
                                </a>
                            @endif
                        </small>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-1">
                                <a href="/profile/{!! $twit->twit->user->id !!}">
                                    @if(!empty($twit->twit->user->preview))
                                        <img src="/{!! $twit->twit->user->preview !!}" width="60" height="60" class="img-circle">
                                    @else
                                        <img src="/public/img/default.jpg" width="60" height="60" class="img-circle">
                                    @endif
                                </a>
                                <span style="margin: auto 25%; color: #9e9e9e;">{!! $twit->twit->user->getStatus() !!}</span>
                            </div>
                            <div class="col-lg-8" >
                    <p style="padding-left: 35px;">
                        <small style="float: left;">
                            <a href="/profile/{!! $twit->twit->user->id !!}">{!! $twit->twit->user->name !!}</a><br>{!! $twit->getDateTwitShare() !!}
                        </small>

                    </p>
                </div>
            </div>
            </p>
        </div>
        </div>
        <div class="row">
            <div class="col-lg-12" >


                {!! $twit->content !!}
                <div class="row" style="border-radius: 7px; border-top: 1px solid #DDDDDD;margin: 5px; cursor: pointer; border-left: 3px solid #DDDDDD; padding: 10px; margin-bottom: 5px;">

                    <div class="col-lg-12" >
                        <p >
                            <small style="float: right;"></small><br>{!! $twit->twit->content !!}
                        @if(!empty($twit->twit->picture))
                            <div class="fixed-size">
                                <a href="/{!! $twit->twit->picture !!}">
                                    <img src="/{!! $twit->twit->picture !!}" width=100% height=100% class="img-responsive" />
                                </a>
                            </div>
                            @endif
                            </p>
                    </div>
                    <span class="pull-right" style="padding: 10px;">
                        <form id="test-form_{!! $twit->id !!}" class="mfp-hide white-popup-block">
                            <div class="form-group">
                                {!! Form::textarea('content_share', false,['id' => 'form_content_share','class' => 'form-control','rows' => '5', 'placeholder' => 'Comment for share...']) !!}
                            </div>
                            {!! Form::button('Поделиться записью', ['id' => $twit->twit->id, 'class' => 'twit_click_share btn btn-primary']) !!}
                        </form>
                        <a id="click_twit_share_{!! $twit->twit->id !!}" @if (!($twit->twit->hasUserTwit(Auth::user()))) data-parameter="{!! $twit->twit->id !!}" class=" popup-with-form" href="#test-form_{!! $twit->twit->id !!}" style="text-decoration: none;" @else style="color: #114CFF;text-decoration: none;" @endif data-toggle="tooltip" data-placement="left" title="Share"><i class="fa fa-bullhorn" ></i> <span class="twit_click_share_span_{!! $twit->twit->id !!}"> {!! $twit->twit->getCountRepost() !!}</span></a>
                    </span>
                    <span class="pull-left" style="padding: 10px;">
                        <a data-parameter="{!! $twit->id !!}"  @if (!($twit->hasUserLike(Auth::user())))  class="twit-not-like" style="text-decoration: none;" @else class="twit-like"  style="color: red;text-decoration: none;" @endif title="Loved"><i class="fa fa-heart"></i><span class="twit_like_span_{!! $twit->id !!}"> {!! $twit->getCountLikes(0) !!}</span></a>
                    </span>
                </div>
                        @include('comment.list')
                <!--</p>-->
            </div>
        </div>
        </div>


    @else


        <div id="twit_{!! $twit->id !!}" style=" cursor: pointer; border: 1px solid #CCCCCC;border-radius: 10px; padding: 20px; margin-bottom: 5px;">
            <div class="row" >
                <div class="col-lg-2">
                    <a href="/profile/{!! $twit->user->id !!}">
                        @if(!empty($twit->user->preview))
                            <img src="/{!! $twit->user->preview !!}" width="75" height="75" class="img-circle">
                        @else
                            <img src="/public/img/default.jpg" width="75" height="75" class="img-circle">
                        @endif
                    </a>
                    <span style="margin: auto 25%; color: #9e9e9e;">{!! $user->getStatus() !!}</span>
                </div>
                <div class="col-lg-10" >
                    <p style="padding-left: 15px;"><small style="float: left;"><a href="/profile/{!! $twit->user->id !!}">{!! $twit->user->name !!}</a><br>{!! $twit->getDate() !!}<br><span style="font-size: 14px;color: #717171;"><i class="fa fa-at"></i>{!! $twit->user->nickname !!}</span></small><small style="float: right;">
                            @if ($twit->user == Auth::user())
                                <a class="twit_remove" data-parameter="{!! $twit->id !!}" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove"><i class="fa fa-remove"></i></a>
                            @endif
                        </small><br>


                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" ><br>
                    <p>{!! $twit->content !!}</p>
                    @if(isset($twit->picture))
                        <div class="fixed-size">
                            <a href="/{!! $twit->picture !!}">
                                <img src="/{!! $twit->picture !!}" width=100% height=100% class="img-responsive" />
                            </a>
                        </div>
                @endif
                <!--</p>-->

                </div>

                <span class="pull-right" style="padding: 10px;">
                                               <!--<a href="#" data-toggle="tooltip" data-placement="left" title="Comments"><i class="fa fa-comments" ></i> 30</a>-->
                    <form id="test-form_{!! $twit->id !!}" class="mfp-hide white-popup-block">
                        <div class="form-group">
                            {!! Form::textarea('content_share', false,['id' => 'form_content_share','class' => 'form-control','rows' => '5', 'placeholder' => 'Comment for share...']) !!}
                        </div>
                    {!! Form::button('Repost', ['id' => $twit->id, 'class' => 'twit_click_share btn btn-primary']) !!}
                    </form>

                    <a id="click_twit_share_{!! $twit->id !!}" @if (!($twit->hasUserTwit(Auth::user()))) data-parameter="{!! $twit->id !!}" class=" popup-with-form" href="#test-form_{!! $twit->id !!}" style="text-decoration: none;" @else style="color: #114CFF;text-decoration: none;" @endif data-toggle="tooltip" data-placement="left" title="Share"><i class="fa fa-bullhorn" ></i> <span class="twit_click_share_span_{!! $twit->id !!}"> {!! $twit->getCountRepost() !!}</span></a>
                </span>
                <span class="pull-left" style="padding: 10px;">
                     <a data-parameter="{!! $twit->id !!}"  @if (!($twit->hasUserLike(Auth::user())))  class="twit-not-like" style="text-decoration: none;" @else class="twit-like"  style="color: red;text-decoration: none;" @endif title="Loved"><i class="fa fa-heart"></i><span class="twit_like_span_{!! $twit->id !!}"> {!! $twit->getCountLikes(0) !!}</span></a>
                    <span class="reply" data-user="{!! $twit->user->nickname !!}" data-parameter="{!! $twit->id !!}">{!! Html::image('/icon/reply.png', 'reply', ['width' => 20, 'height' => 20]) !!}</span>
                </span>
            </div>


            @include('comment.list')

        </div>
    @endif
@endforeach

<script>
    $(document).ready(function () {
        $('.comment-btn').click(function () {
            var comment_id = this.getAttribute("data-parameter");
            $.ajax({
                type: 'POST',
                data: { '_token': $('#signup-token').val() , 'comment': $('#comment_' + comment_id).val()},
                url: "/twit/comment/" + comment_id,
                dataType: 'html',
                success: function (date) {
                    $('#actionBox_' + comment_id).append(date);
                    $('#comment_' + comment_id).val('');
                }
            });
        });
        $('.comment_delete').click(function () {
            var comment_id = this.getAttribute("data-parameter");
            $.ajax({
                type: 'POST',
                data: { '_token': $('#signup-token').val()},
                url: "/twit/comment/delete/" + comment_id,
                success: function () {
                    $('#comment_delete_' + comment_id).remove();
                }
            });
        });

        $('.comment_like').click(function () {
            var comment_id = this.getAttribute("data-parameter");
            if (comment_id)
                $.ajax({
                    type: 'POST',
                    data: { '_token': $('#signup-token').val()},
                    url: "/twit/comment/like/" + comment_id,
                    success: function () {
                        $('#comment_like_count_' + comment_id).text(function (index, text) {
                            return ++text;
                        })
                        $('#comment_like_icon_' + comment_id).removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
                        $('#comment_like_' + comment_id).unbind('click');
                    }
                });
        });

        $('.reply').click(function () {
            twit_id = this.getAttribute("data-parameter");
            $('#comment_' + twit_id).val('@' + this.getAttribute("data-user") + ', ');
        });

    });

</script>

