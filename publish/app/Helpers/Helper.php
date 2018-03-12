<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Form;
use Html;

class Helper
{
    public static function comment(User $user, $comment, Carbon $current_date, $comment){
        $html = '<ul id="comment_delete_' . $comment->id . '" style="overflow: hidden; border-bottom: 1px solid #DDDDDD">';
        $html .= '<div class="commenterImage">';
        $html .= '<img src="/' . Auth::user()->preview . '"/>';
        $html .= '</div>';
        $html .= '<div class="commentText">';
        $html .= '<a href="/profile/' . Auth::user()->id . '"><h5 style="margin: 5px auto 0px auto;">' . Auth::user()->name . '</h5></a>';
        $html .= '<small style="color: #A0A0A0;">' . $current_date->format('j F Y G:i') . '</small>';
        $html .= '<p style="margin-top: 5px;">' . $comment->comment . '</p>';
        //if($comment->isUserComment(Auth::user()) || Auth::user() == $user)
        //    $html .= '<a style="float:right;" class="comment_delete" data-parameter="' . $comment->id . '"><small>Delete</small></a>';
        //$html .= '<a id="comment_like_' .$comment->id . '" class="';
        //if(!$comment->hasUserLike(Auth::user()))
        //    $html .= 'comment_like' . $comment->id;
        //$html .= '" data-parameter="' . $comment->id . '"><small>';
        //$html .= '<span id="comment_like_icon_'.  $comment->id . '" class="fa ';
        //if($comment->hasUserLike(Auth::user()))
        //    $html .= 'fa-thumbs-up';
        //else
        //    $html .= 'fa-thumbs-o-up';
        //$html .= '"></span>';
        //$html .= '<span id="comment_like_count_' .$comment->id . '">' . $comment->getCountLikes() . '</span></small></a>';
        $html .= '</div>';
        $html .= '</ul>';

        return $html;
    }

    /*public static function renderSimpleTwit($twit, $user){
        $html = '<div id="twit_' . $twit->id . '" style=" cursor: pointer; border: 1px solid #CCCCCC;border-radius: 10px; padding: 20px; margin-bottom: 5px;">';
        $html .= '<div class="row" >';
        $html .= '<div class="col-lg-2">';
        $html .= '<a href="/profile/' . $twit->user->id . '">';
        if(!empty($twit->user->preview))
            $html .= '<img src="/' . $twit->user->preview . '" width="75" height="75" class="img-circle">';
        else
            $html .= '<img src="/public/img/default.jpg" width="75" height="75" class="img-circle">';
        $html .= '</a>';
        $html .= '<span style="margin: auto 25%; color: #9e9e9e;">' . $user->getStatus() . '</span>';
        $html .= '</div>';
        $html .= '<div class="col-lg-10" >';
        $html .= '<p style="padding-left: 15px;"><small style="float: left;">';
        $html .= '<a href="/profile/' . $twit->user->id . '">' . $twit->user->name . '</a><br>' . $twit->getDate() . '<br>';
        $html .= '<span style="font-size: 14px;color: #717171;"><i class="fa fa-at"></i>' . $twit->user->nickname . '</span></small>';
        $html .= '<small style="float: right;">';
        if ($twit->user == Auth::user())
            $html .= '<a class="twit_remove" data-parameter="' . $twit->id . '" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove"><i class="fa fa-remove"></i></a>';
        $html .= '</small><br>';
        $html .= '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12" ><br>';
        $html .= '<p>' . $twit->content . '</p>';
        if(isset($twit->picture)){
            $html .= '<div class="fixed-size">';
            $html .= '<a href="/' . $twit->picture . '">';
            $html .= '<img src="/' . $twit->picture . '" width=100% height=100% class="img-responsive" />';
            $html .= '</a>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '<span class="pull-right" style="padding: 10px;">';
        $html .= '<form id="test-form_' . $twit->id . '" class="mfp-hide white-popup-block">';
        $html .= '<div class="form-group">';
        $html .= Form::textarea('content_share', false,['id' => 'form_content_share','class' => 'form-control','rows' => '5', 'placeholder' => 'Comment for share...']);
        $html .= '</div>';
        $html .= Form::button('Repost', ['id' => $twit->id, 'class' => 'twit_click_share btn btn-primary']);
        $html .= '</form>';
        $html .= '<a id="click_twit_share_' . $twit->id . '"';
        if (!($twit->hasUserTwit(Auth::user())))
            $html .= 'data-parameter="' . $twit->id . '" class=" popup-with-form" href="#test-form_' . $twit->id .'" style="text-decoration: none;"';
        else
            $html .= ' style="color: #114CFF;text-decoration: none;"';
        $html .= 'data-toggle="tooltip" data-placement="left" title="Share"><i class="fa fa-bullhorn" ></i> <span class="twit_click_share_span_' . $twit->id . '"> ' . $twit->getCountRepost() . '</span></a>';
        $html .= '</span>';
        $html .= '<span class="pull-left" style="padding: 10px;">';
        $html .= '<a data-parameter="' . $twit->id . '"  ';
        if (!($twit->hasUserLike(Auth::user())))
            $html .= 'class="twit-not-like" style="text-decoration: none;"';
        else
            $html .= 'class="twit-like"  style="color: red;text-decoration: none;"';
        $html .= 'title="Loved"><i class="fa fa-heart"></i><span class="twit_like_span_' . $twit->id . '"> ' . $twit->getCountLikes() . '</span></a>';
        $html .= '<span class="reply" data-user="' . $twit->user->nickname . '" data-parameter="' . $twit->id . '">' . Html::image('/icon/reply.png', 'reply', ['width' => 20, 'height' => 20]) . '</span>';
        $html .= '</span>';
        $html .= '</div>';
        $html .= self::renderCommentBlock($twit, $user);
        $html .= '</div>';

        return $html;
    }*/

    public static function renderSimpleTwit($twit, $user){
        $html = '<div id="twit_' . $twit->id . '" style=" cursor: pointer; border: 1px solid #CCCCCC;border-radius: 10px; padding: 20px; margin-bottom: 5px;">';
        $html .= '<div class="row" >';
        $html .= '<div class="col-lg-2">';
        if($twit->user)
            $html .= '<a href="/profile/' . $twit->user->id . '">';
        else
            $html .= '<a href="/group/' . $twit->group->id . '">';
        if ($twit->user) {
            if (!empty($twit->user->preview))
                $html .= '<img src="/' . $twit->user->preview . '" width="75" height="75" class="img-circle">';
            else
                $html .= '<img src="/public/img/default.jpg" width="75" height="75" class="img-circle">';
            $html .= '</a>';
        }
        else{
            if (!empty($twit->group->preview))
                $html .= '<img src="/' . $twit->group->preview . '" width="75" height="75" class="img-circle">';
            else
                $html .= '<img src="/public/img/default.jpg" width="75" height="75" class="img-circle">';
            $html .= '</a>';
        }
        if ($twit->user)
            $html .= '<span style="margin: auto 25%; color: #9e9e9e;">' . $user->getStatus() . '</span>';
        $html .= '</div>';
        $html .= '<div class="col-lg-10" >';
        $html .= '<p style="padding-left: 15px;"><small style="float: left;">';
        if ($twit->user) {
            $html .= '<a href="/profile/' . $twit->user->id . '">' . $twit->user->name . '</a><br>' . $twit->getDate() . '<br>';
            $html .= '<span style="font-size: 14px;color: #717171;"><i class="fa fa-at"></i>' . $twit->user->nickname . '</span></small>';
        }
        else {
            $html .= '<a href="/group/' . $twit->group->id . '">' . $twit->group->name . '</a><br>' . $twit->getDate() . '<br>';
            $html .= '<span style="font-size: 14px;color: #717171;"><i class="fa fa-at"></i>' . $twit->group->name . '</span></small>';
        }
        if ($twit->user) {
            $html .= '<small style="float: right;">';
            if ($twit->user == Auth::user())
                $html .= '<a class="twit_remove" data-parameter="' . $twit->id . '" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove"><i class="fa fa-remove"></i></a>';
            $html .= '</small><br>';
        }
        else{
            $html .= '<small style="float: right;">';
            if ($twit->group->user == Auth::user())
                $html .= '<a class="twit_remove" data-parameter="' . $twit->id . '" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove"><i class="fa fa-remove"></i></a>';
            $html .= '</small><br>';
        }
        $html .= '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12" ><br>';
        $html .= '<p>' . $twit->content . '</p>';
        if(isset($twit->picture)){
            $html .= '<div class="fixed-size">';
            $html .= '<a href="/' . $twit->picture . '">';
            $html .= '<img src="/' . $twit->picture . '" width=100% height=100% class="img-responsive" />';
            $html .= '</a>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '<span class="pull-right" style="padding: 10px;">';
        $html .= '<form id="test-form_' . $twit->id . '" class="mfp-hide white-popup-block">';
        $html .= '<div class="form-group">';
        $html .= Form::textarea('content_share', false,['id' => 'form_content_share','class' => 'form-control','rows' => '5', 'placeholder' => 'Comment for share...']);
        $html .= '</div>';
        $html .= Form::button('Repost', ['id' => $twit->id, 'class' => 'twit_click_share btn btn-primary']);
        $html .= '</form>';
        $html .= '<a id="click_twit_share_' . $twit->id . '"';
        if (!($twit->hasUserTwit(Auth::user())))
            $html .= 'data-parameter="' . $twit->id . '" class=" popup-with-form" href="#test-form_' . $twit->id .'" style="text-decoration: none;"';
        else
            $html .= ' style="color: #114CFF;text-decoration: none;"';
        $html .= 'data-toggle="tooltip" data-placement="left" title="Share"><i class="fa fa-bullhorn" ></i> <span class="twit_click_share_span_' . $twit->id . '"> ' . $twit->getCountRepost() . '</span></a>';
        $html .= '</span>';
        $html .= '<span class="pull-left" style="padding: 10px;">';
        $html .= '<a data-parameter="' . $twit->id . '"  ';

        if (!($twit->hasUserLike(Auth::user())))
            $html .= 'class="twit-not-like" style="text-decoration: none;"';
        else
            $html .= 'class="twit-like"  style="color: red;text-decoration: none;"';
        $html .= 'title="Loved"><i class="fa fa-heart"></i><span class="twit_like_span_' . $twit->id . '"> ' . $twit->getCountLikes() . '</span></a>';
        if ($twit->user){
            $html .= '<span class="reply" data-user="' . $twit->user->nickname . '" data-parameter="' . $twit->id . '">' . Html::image('/icon/reply.png', 'reply', ['width' => 20, 'height' => 20]) . '</span>';
            $html .= '</span>';
        }
        $html .= '</div>';
        $html .= self::renderCommentBlock($twit, $user);
        $html .= '</div>';

        return $html;
    }

    public static function renderComment($comment, $user){
        $html = '<ul id="comment_delete_' . $comment->id . '" style="overflow: hidden; border-bottom: 1px solid #DDDDDD">';
        $html .= '<div class="commenterImage">';
        if(!empty($comment->getUser()->preview))
            $html .= '<img src="/' . $comment->getUser()->preview . '">';
        else
            $html .= '<img src="/public/img/default.jpg">';
        $html .= '</div>';
        $html .= '<div class="commentText">';
        $html .= '<small style="color: #A0A0A0;">' . $comment->created_at->format('j F Y G:i') . '</small>';
        $html .= '<br><a href="/profile/' . $comment->getUser()->id . '"><span style="font-size: 14px; color: #717171"><i class="fa fa-at"></i>' . $comment->getUser()->nickname . '</span></a>';
        $html .= '<p style="margin: 20px auto 20px;">' . $comment->comment . '</p>';
        if($comment->isUserComment(Auth::user()) || Auth::user() == $user)
            $html .= '<a style="float:right;" class="comment_delete" data-parameter="' . $comment->id . '"><small>Delete</small></a>';
        $html .= '<a id="comment_like_' . $comment->id . '" class="';
        if(!$comment->hasUserLike(Auth::user()))
            $html .= 'comment_like"';
        $html .= ' data-parameter="' . $comment->id . '"><small>';
        $html .= '<span id="comment_like_icon_' . $comment->id . '" class="';
        if($comment->hasUserLike(Auth::user()))
            $html .= 'fa-thumbs-up';
        else
            $html .= 'fa-thumbs-o-up';
        $html .= ' fa"></span>';
        $html .= '<span id="comment_like_count_' . $comment->id . '"> ' . $comment->getCountLikes() . '</span></small></a>';
        $html .= '<span class="reply" data-user="' . $comment->getUser()->nickname . '" data-parameter="' . $comment->twit->id . '">' . Html::image('/icon/reply.png', 'reply', ['width' => 20, 'height' => 20]) . '</span>';
        $html .= '</div>';
        $html .= '</ul>';

        return $html;
    }

    public static function renderCommentAdd($comment, $user){
        $html = '<ul id="comment_delete_' . $comment->id . '" style="overflow: hidden; border-bottom: 1px solid #DDDDDD">';
        $html .= '<div class="commenterImage">';
        if(!empty($comment->getUser()->preview))
            $html .= '<img src="/' . $comment->getUser()->preview . '">';
        else
            $html .= '<img src="/public/img/default.jpg">';
        $html .= '</div>';
        $html .= '<div class="commentText">';
        $html .= '<small style="color: #A0A0A0;">' . $comment->created_at->format('j F Y G:i') . '</small>';
        $html .= '<br><a href="/profile/' . $comment->getUser()->id . '"><span style="font-size: 14px; color: #717171"><i class="fa fa-at"></i>' . $comment->getUser()->nickname . '</span></a>';
        $html .= '<p style="margin: 20px auto 20px;">' . $comment->comment . '</p>';
        if($comment->isUserComment(Auth::user()) || Auth::user() == $user)
            $html .= '<a style="float:right;" class="comment_delete" data-parameter="' . $comment->id . '"><small>Delete</small></a>';
        $html .= '</div>';
        $html .= '</ul>';

        return $html;
    }

    public static function renderCommentBlock($twit, $user){
        $html = '<div class="actionBox">';
        foreach($twit->getComments() as $comment)
            $html .= self::renderComment($comment, $user);
        $html .= '<div id="actionBox_' . $twit->id . '"></div>';
        $html .= csrf_field();
        $html .= '<div class="form-inline">';
        $html .= '<div class="form-group" style="width: 74%;">';
        $html .= '<input id="comment_' . $twit->id . '" class=" form-control" name="comment" style="width:  -webkit-fill-available;" type="text" placeholder="Your comments" />';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '<a  data-parameter="' . $twit->id . '" class=" comment-btn btn btn-default">Comment <img src="/icon/comment.png" width="20" height="20" style="margin-left: 5px;"></a>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }



    public static function renderJSComment(){
        $js = "<script>
    $(document).ready(function () {
        $('.comment_delete').click(function () {
            var comment_id = this.getAttribute(\"data-parameter\");
            $.ajax({
                type: 'POST',
                data: { '_token': $('#signup-token').val()},
                url: \"/twit/comment/delete/\" + comment_id,
                success: function () {
                    $('#comment_delete_' + comment_id).remove();
                }
            });
        });       
    });
</script>";

        return $js;
    }

    public static function renderJS(){
        $js = "<script>
    $(document).ready(function () {
        $('.comment-btn').click(function () {
            var comment_id = this.getAttribute(\"data-parameter\");
            $.ajax({
                type: 'POST',
                data: { '_token': $('#signup-token').val() , 'comment': $('#comment_' + comment_id).val()},
                url: \"/twit/comment/\" + comment_id,
                dataType: 'html',
                success: function (date) {
                    $('#actionBox_' + comment_id).append(date);
                    $('#comment_' + comment_id).val('');
                }
            });
        });
        $('.comment_delete').click(function () {
            var comment_id = this.getAttribute(\"data-parameter\");
            $.ajax({
                type: 'POST',
                data: { '_token': $('#signup-token').val()},
                url: \"/twit/comment/delete/\" + comment_id,
                success: function () {
                    $('#comment_delete_' + comment_id).remove();
                }
            });
        });
        $('.comment_like').click(function () {
            var comment_id = this.getAttribute(\"data-parameter\");
            if (comment_id)
                $.ajax({
                    type: 'POST',
                    data: { '_token': $('#signup-token').val()},
                    url: \"/twit/comment/like/\" + comment_id,
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
            twit_id = this.getAttribute(\"data-parameter\");
            $('#comment_' + twit_id).val('@' + this.getAttribute(\"data-user\") + ', ');
        });
            
            handlerPopUp();
             $('.captions').lightGallery();
            $('.fixed-size').lightGallery({
                width: '1000px',
                height: '670px',
                mode: 'lg-fade',
                addClass: 'fixed-size',
                counter: false,
                download: false,
                startClass: '',
                enableSwipe: false,
                enableDrag: false,
                speed: 500
            });       
    });
</script>";

        return $js;
    }

    public static function renderJStwit(){
        $js = '<script>
        function likesClickListener(element, twit_id) {
            $.ajax({
                url: "/twit/like/" + twit_id,
                success: function () {
                    $(element).children(\'span\').text(function (index, text) {
                        return ++text;
                    });
                    $(element).css(\'color\', \'red\');
                    $(element).unbind(\'click\');
                    $(element).click(function () {
                        var twit_id = this.getAttribute("data-parameter");
                        if(twit_id)
                            removeLikesClickListener(this, twit_id);
                    });
                }
            });
        };
        function removeLikesClickListener(element, twit_id) {
            $.ajax({
                url: "/twit/like-remove/" + twit_id,
                success: function () {
                    $(element).children(\'span\').text(function (index, text) {
                        return --text;
                    });
                    $(element).css(\'color\', \'blue\');
                    $(element).unbind(\'click\');
                    $(element).click(function () {
                        var twit_id = this.getAttribute("data-parameter");
                        if(twit_id)
                            likesClickListener(this, twit_id);
                    });
                }
            });
        };
        function removeClickListener(twit_id) {
            $.ajax({
                url: "/twit/delete/" + twit_id,
                success: function () {
                    $(\'#twit_\' + twit_id).hide(\'slow\', function(){
                        $(this).remove();
                    });
                }
            });
        };
        function repostClickListener(element, twit_id, content_share) {
            $.ajax({
                url: "/twit/repost/" + twit_id,
                method: \'post\',
                data: { \'_token\': $(\'#signup-token\').val(), \'content_share\' : content_share},
                success: function () {
                    $(\'#click_twit_share_\' + twit_id).children(\'span\').text(function (index, text) {
                        return ++text;
                    });
                    $(\'#click_twit_share_\' + twit_id).css(\'color\', \'#114CFF\');
                    $(\'.popup-with-form\').unbind();
                    $(\'#click_twit_share_\' + twit_id).removeClass(\'popup-with-form\');
                    handlerPopUp();
                    $.magnificPopup.close();
                }
            });
        };

        $(document).ready(function(){
            /*var start = 6;
            $(\'#download\').click(function () {
                $.ajax({
                    type: \'POST\',
                    data: { \'_token\': $(\'#signup-token\').val(), start : start },
                    url: "/twit/paginate/" + this.getAttribute("data-parameter"),
                    dataType: \'json\',
                    success: function (date) {
                        $(\'#download\').before(date.html);
                        start += 5;
                        if (!date.load)
                            $(\'#download\').remove();
                    }
                });
            });*/

            $(\'.twit-like\').click(function () {
                var twit_id = this.getAttribute("data-parameter");
                if(twit_id)
                    removeLikesClickListener(this, twit_id);
            });
            $(\'.twit-not-like\').click(function () {
                var twit_id = this.getAttribute("data-parameter");
                if(twit_id)
                    likesClickListener(this, twit_id);
            });
            $(\'.twit_remove\').click(function () {
                var twit_id = this.getAttribute("data-parameter");
                if(twit_id)
                    removeClickListener(twit_id);
            });
  
            $(\'.twit_click_share\').click(function () {
                var twit_id = this.getAttribute("id");
                var content_share = $(\'#form_content_share\').val();
                if(twit_id)
                    repostClickListener(this, twit_id, content_share);
            });
            $(\'.captions\').lightGallery();
            $(\'.fixed-size\').lightGallery({
                width: \'1000px\',
                height: \'670px\',
                mode: \'lg-fade\',
                addClass: \'fixed-size\',
                counter: false,
                download: false,
                startClass: \'\',
                enableSwipe: false,
                enableDrag: false,
                speed: 500
            });
            handlerPopUp();
            
        });
    </script>';

        return $js;
    }

   /* public static function renderRepostTwit($twit, $user){
        $html = '<div id="twit_' . $twit->id . '" style="cursor: pointer; border: 1px solid #CCCCCC;border-radius: 10px; padding: 10px; margin-bottom: 5px;">';
        $html .= '<div class="row" >';
        $html .= '<div class="col-lg-2">';
        $html .= '<a href="/profile/' . $user->id . '">';
        if(!empty($user->preview))
            $html .= '<img src="/' . $user->preview . '" width="75" height="75" class="img-circle">';
        else
            $html .= '<img src="/public/img/default.jpg" width="75" height="75" class="img-circle">';
        $html .= '</a>';
        $html .= '<span style="margin: auto 25%; color: #9e9e9e;">' . $user->getStatus() . '</span>';
        $html .= '</div>';
        $html .= '<div class="col-lg-10" >';
        $html .= '<p style="padding-left: 15px;"><small style="float: left;">';
        $html .= '<a href="/profile/' . $twit->user->id . '">' . $user->name . '</a><br>' . $twit->getDate() . '';
        $html .= '</small><small style="float: right;">';
        if ($user == Auth::user()) {
            $html .= '<a class="twit_remove" data-parameter="' . $twit->id . '" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove">';
            $html .= '<i class="fa fa-remove"></i>';
            $html .= '</a>';
        }
        $html .= '</small><br><br>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-1">';
        $html .= '<a href="/profile/' . $twit->twit->user->id . '">';
        if(!empty($twit->twit->user->preview))
             $html .= ' <img src="/' . $twit->twit->user->preview . '" width="60" height="60" class="img-circle">';
        else
            $html .= '<img src="/public/img/default.jpg" width="60" height="60" class="img-circle">';
        $html .= '</a>';
        $html .= '<span style="margin: auto 25%; color: #9e9e9e;">' .  $twit->twit->user->getStatus() . '</span>';
        $html .= '</div>';
        $html .= '<div class="col-lg-8" >';
        $html .= '<p style="padding-left: 35px;">';
        $html .= '<small style="float: left;">';
        $html .= '<a href="/profile/' . $twit->twit->user->id . '">' . $twit->twit->user->name . '</a><br>' . $twit->getDateTwitShare() . '';
        $html .= '</small>';
        $html .= '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12" >';
        $html .= $twit->content;
        $html .= '<div class="row" style="border-radius: 7px; border-top: 1px solid #DDDDDD;margin: 5px; cursor: pointer; border-left: 3px solid #DDDDDD; padding: 10px; margin-bottom: 5px;">';
        $html .= '<div class="col-lg-12" >';
        $html .= '<p >';
        $html .= '<small style="float: right;"></small><br>' . $twit->twit->content . '';
        if(!empty($twit->twit->picture)) {
            $html .= '<div class="fixed-size">';
            $html .= '<a href="/' . $twit->twit->picture . '">';
            $html .= '<img src="/' . $twit->twit->picture . '" width=100% height=100% class="img-responsive" />';
            $html .= '</a>';
            $html .= '</div>';
        }
        $html .= '</p>';
        $html .= '</div>';
        $html .= '<span class="pull-right" style="padding: 10px;">';
        $html .= '<form id="test-form_' . $twit->id . '" class="mfp-hide white-popup-block">';
        $html .= '<div class="form-group">';
        $html .= Form::textarea('content_share', false,['id' => 'form_content_share','class' => 'form-control','rows' => '5', 'placeholder' => 'Comment for share...']);
        $html .= '</div>';
        $html .= Form::button('Поделиться записью', ['id' => $twit->twit->id, 'class' => 'twit_click_share btn btn-primary']);
        $html .= '</form>';
        $html .= '<a id="click_twit_share_{!! $twit->twit->id !!}" ';
        if (!($twit->twit->hasUserTwit(Auth::user())))
            $html .= 'data-parameter="' . $twit->twit->id . '" class=" popup-with-form" href="#test-form_' . $twit->twit->id . '" style="text-decoration: none;"';
        else
            $html .= ' style="color: #114CFF;text-decoration: none;" ';
        $html .= ' data-toggle="tooltip" data-placement="left" title="Share"><i class="fa fa-bullhorn" ></i> <span class="twit_click_share_span_' . $twit->twit->id . '"> ' . $twit->twit->getCountRepost() . '</span></a>';
        $html .= ' </span>';
        $html .= '<span class="pull-left" style="padding: 10px;">';
        $html .= '<a data-parameter="' . $twit->id . '"  ';
        if (!($twit->hasUserLike(Auth::user())))
            $html .= ' class="twit-not-like" style="text-decoration: none;" ';
        else
            $html .= ' class="twit-like"  style="color: red;text-decoration: none;" ';
        $html .= 'title="Loved"><i class="fa fa-heart"></i><span class="twit_like_span_' . $twit->id . '"> ' . $twit->getCountLikes() . '</span></a>';
        $html .= '</span>';
        $html .= '</div>';
        $html .= self::renderCommentBlock($twit, $user);;
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }*/

    public static function renderRepostTwit($twit, $user){
        $html = '<div id="twit_' . $twit->id . '" style="cursor: pointer; border: 1px solid #CCCCCC;border-radius: 10px; padding: 10px; margin-bottom: 5px;">';
        $html .= '<div class="row" >';
        $html .= '<div class="col-lg-2">';
        $html .= '<a href="/profile/' . $user->id . '">';
        if(!empty($user->preview))
            $html .= '<img src="/' . $user->preview . '" width="75" height="75" class="img-circle">';
        else
            $html .= '<img src="/public/img/default.jpg" width="75" height="75" class="img-circle">';
        $html .= '</a>';
        $html .= '<span style="margin: auto 25%; color: #9e9e9e;">' . $user->getStatus() . '</span>';
        $html .= '</div>';
        $html .= '<div class="col-lg-10" >';
        $html .= '<p style="padding-left: 15px;"><small style="float: left;">';
        if($twit->user)
            $html .= '<a href="/profile/' . $twit->user->id . '">' . $user->name . '</a><br>' . $twit->getDate() . '';
        else
            $html .= '<a href="/profile/' . $twit->group->id . '">' . $user->name . '</a><br>' . $twit->getDate() . '';
        $html .= '</small><small style="float: right;">';
        if($twit->user) {
            if ($user == Auth::user()) {
                $html .= '<a class="twit_remove" data-parameter="' . $twit->id . '" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove">';
                $html .= '<i class="fa fa-remove"></i>';
                $html .= '</a>';
            }
        }
        else{
            if ($twit->group->user == Auth::user()) {
                $html .= '<a class="twit_remove" data-parameter="' . $twit->id . '" style="padding-left: 5px;"  data-toggle="tooltip" data-placement="right" title="Remove">';
                $html .= '<i class="fa fa-remove"></i>';
                $html .= '</a>';
            }
        }
        $html .= '</small><br><br>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-1">';
        if($twit->twit->user)
            $html .= '<a href="/profile/' . $twit->twit->user->id . '">';
        else
            $html .= '<a href="/group/' . $twit->twit->group->id . '">';
        if($twit->twit->user) {
            if (!empty($twit->twit->user->preview))
                $html .= ' <img src="/' . $twit->twit->user->preview . '" width="60" height="60" class="img-circle">';
            else
                $html .= '<img src="/public/img/default.jpg" width="60" height="60" class="img-circle">';
        }
        else
        {
            if (!empty($twit->twit->group->preview))
                $html .= ' <img src="/' . $twit->twit->group->preview . '" width="60" height="60" class="img-circle">';
            else
                $html .= '<img src="/public/img/default.jpg" width="60" height="60" class="img-circle">';
        }
        $html .= '</a>';
        if(isset($twit->twit->user))
            $html .= '<span style="margin: auto 25%; color: #9e9e9e;">' .  $twit->twit->user->getStatus() . '</span>';
        $html .= '</div>';
        $html .= '<div class="col-lg-8" >';
        $html .= '<p style="padding-left: 35px;">';
        $html .= '<small style="float: left;">';
        if($twit->twit->user)
            $html .= '<a href="/profile/' . $twit->twit->user->id . '">' . $twit->twit->user->name . '</a><br>' . $twit->getDateTwitShare() . '';
        else
            $html .= '<a href="/group/' . $twit->twit->group->id . '">' . $twit->twit->group->name . '</a><br>' . $twit->getDateTwitShare() . '';
        $html .= '</small>';
        $html .= '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</p>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12" >';
        $html .= $twit->content;
        $html .= '<div class="row" style="border-radius: 7px; border-top: 1px solid #DDDDDD;margin: 5px; cursor: pointer; border-left: 3px solid #DDDDDD; padding: 10px; margin-bottom: 5px;">';
        $html .= '<div class="col-lg-12" >';
        $html .= '<p >';
        $html .= '<small style="float: right;"></small><br>' . $twit->twit->content . '';
        if (!empty($twit->twit->picture)) {
            $html .= '<div class="fixed-size">';
            $html .= '<a href="/' . $twit->twit->picture . '">';
            $html .= '<img src="/' . $twit->twit->picture . '" width=100% height=100% class="img-responsive" />';
            $html .= '</a>';
            $html .= '</div>';
        }
        $html .= '</p>';
        $html .= '</div>';
        $html .= '<span class="pull-right" style="padding: 10px;">';
        $html .= '<form id="test-form_' . $twit->id . '" class="mfp-hide white-popup-block">';
        $html .= '<div class="form-group">';
        $html .= Form::textarea('content_share', false,['id' => 'form_content_share','class' => 'form-control','rows' => '5', 'placeholder' => 'Comment for share...']);
        $html .= '</div>';
        $html .= Form::button('Поделиться записью', ['id' => $twit->twit->id, 'class' => 'twit_click_share btn btn-primary']);
        $html .= '</form>';
        $html .= '<a id="click_twit_share_{!! $twit->twit->id !!}" ';
        if (!($twit->twit->hasUserTwit(Auth::user())))
            $html .= 'data-parameter="' . $twit->twit->id . '" class=" popup-with-form" href="#test-form_' . $twit->twit->id . '" style="text-decoration: none;"';
        else
            $html .= ' style="color: #114CFF;text-decoration: none;" ';
        $html .= ' data-toggle="tooltip" data-placement="left" title="Share"><i class="fa fa-bullhorn" ></i> <span class="twit_click_share_span_' . $twit->twit->id . '"> ' . $twit->twit->getCountRepost() . '</span></a>';
        $html .= ' </span>';
        $html .= '<span class="pull-left" style="padding: 10px;">';
        $html .= '<a data-parameter="' . $twit->id . '"  ';
        if (!($twit->hasUserLike(Auth::user())))
            $html .= ' class="twit-not-like" style="text-decoration: none;" ';
        else
            $html .= ' class="twit-like"  style="color: red;text-decoration: none;" ';
        $html .= 'title="Loved"><i class="fa fa-heart"></i><span class="twit_like_span_' . $twit->id . '"> ' . $twit->getCountLikes() . '</span></a>';
        $html .= '</span>';
        $html .= '</div>';
        $html .= self::renderCommentBlock($twit, $user);;
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public static function renderNoticeComment($notice){
        $html = '<ul style="overflow: hidden; border-bottom: 1px solid #DDDDDD; padding: 10px;">';
        $html .= '<a href="/profile/' . $notice->noticeable->getUser()->id . '">';
        $html .= '<div class="commenterImage">';
        if (!empty( $notice->noticeable->getUser()->preview ))
            $html .= '<img src="/' . $notice->noticeable->getUser()->preview . '">';
        else
            $html .= '<img src="/public/img/default.jpg">';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '<div class="commentText">';
        $html .= '<a href="/profile/' . $notice->noticeable->getUser()->id . '">';
        $html .= '<span >' . $notice->noticeable->getUser()->name . '</span>';
        $html .= '</a>';
        $html .= '<span style="font-size: 14px; color: #717171"><small>' . $notice->created_at . '</small></span>';
        $html .= '</div>';
        $html .= '<div class="commentText">';
        $html .= '<img src="/icon/comment.png" width="30" height="30">';
        $html .= '<span>' . $notice->noticeable['comment'] . '</span>';
        $html .= '</div>';
        $html .= '<a href="/twit/show/' . $notice->noticeable->twit->id . '"><span class="pull-right"><small>Show notice</small></span></a>';
        $html .= '</ul>';

        return $html;
    }

    public static function renderNoticeFollow($notice){
        $html = '<ul style="overflow: hidden; border-bottom: 1px solid #DDDDDD; padding: 10px;">';
        $html .= '<a href="/profile/' . $notice->noticeable->getUser()->id . '">';
        $html .= '<div class="commenterImage">';
        if (!empty( $notice->noticeable->getUser()->preview ))
            $html .= '<img src="/' . $notice->noticeable->getUser()->preview . '">';
        else
            $html .= '<img src="/public/img/default.jpg">';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '<div class="commentText">';
        $html .= '<a href="/profile/' . $notice->noticeable->getUser()->id . '">';
        $html .= '<span >' . $notice->noticeable->getUser()->name . '</span>';
        $html .= '</a>';
        $html .= '</div>';
        $html .= '<div class="commentText">';
        $html .= '<img src="/icon/follow.png" width="30" height="30">';
        $html .= '<span>Подписалася на ваши обновления</span>';
        $html .= '</div>';
        $html .= '</ul>';

        return $html;
    }

    public static function renderNoticeLikes($notice){
        $html = '<ul style="overflow: hidden; border-bottom: 1px solid #DDDDDD; padding: 10px;">';
        $html .= '<a href="/profile/' . $notice->noticeable->getUser()->id . '">';
        $html .= '<div class="commenterImage">';
        if (!empty( $notice->noticeable->getUser()->preview ))
            $html .= '<img src="/' . $notice->noticeable->getUser()->preview . '">';
        else
            $html .= '<img src="/public/img/default.jpg">';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '<div class="commentText">';
        $html .= '<a href="/profile/' . $notice->noticeable->getUser()->id . '">';
        $html .= '<span >' . $notice->noticeable->getUser()->name . '</span>';
        $html .= '</a>';
        $html .= '</div>';
        $html .= '<div class="commentText">';
        $html .= '<img src="/icon/like.png" width="30" height="30">';
        $html .= '<span>Понравилась Ваша запись</span>';
        $html .= '</div>';
        $html .= '<a href="/twit/show/' . $notice->noticeable->getTwit()->id . '"><span class="pull-right"><small>Show notice</small></span></a>';
        $html .= '</ul>';

        return $html;
    }

}