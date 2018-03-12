<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Request;
use App\Models\Twit;
use Illuminate\Http\Response as Response;
use App\Http\Requests as Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use App\Events\onDeleteComment;
use App\Events\onAddComment;

class CommentController extends Controller
{
    public function add(Twit $twit){
        $validator = Validator::make(Request::all(), [
            'comment' => 'required',
        ]);
        if ($validator->fails())
            die;

        $params = Request::only('comment');
        $params['comment'] = $this->getLinkNickname($params['comment']);

        $twit->users_comment()->attach(Auth::user(), $params);
        $comment_id = DB::getPdo()->lastInsertId();
        $comment = Comment::find($comment_id);

        Event::fire(new onAddComment($twit->user, $comment));

        return Helper::renderCommentAdd(Comment::find($comment_id), Auth::user()) . Helper::renderJSComment();
    }
    public function delete(Comment $comment){
        Event::fire(new onDeleteComment($comment));
        $comment->delete();
    }

    public function like(Comment $comment){
        $comment->users_like()->attach(Auth::user());
    }

    private function getLinkNickname($string){
        $string = htmlspecialchars($string);
        preg_match_all("(\@[a-zA-Z\_\-]*)", $string, $nickname);
        foreach ($nickname[0] as $nick)
            $string = str_replace($nick, '<span style="color: #2F48DD">' . $nick . '</span>', $string);

        return $string;
    }
}