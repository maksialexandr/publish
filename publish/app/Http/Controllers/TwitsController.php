<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 13.02.2018
 * Time: 16:08
 */

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Group;
use Request;
use App\Models\Twit as Twit;
use App\Models\TwitShare as TwitShare;
use Illuminate\Http\Response as Response;
use App\Http\Requests as Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Events\onDeleteComment;
use Illuminate\Support\Facades\Event;
use App\Models\Notice;
use App\Models\UserHasTwitLikes;

class TwitsController extends Controller
{
    public function index(){
        $users_id = [];
        foreach (Auth::user()->friends as $u)
            $users_id[] = $u->id;
        $twits =  Twit::whereIn('user_id', $users_id)->orderBy('id', 'DESC')->get();

        $notice = Auth::user()->getUnvisibleAndVisibleNotice();

        $params = $notice;
        $params['user'] = Auth::user();
        $params['twits'] = $twits;

        return view('twit.index', $params);
    }

    public function create(){
        if (Request::isMethod('POST')) {
            $v = Validator::make(Request::all(), [
                'content' => 'required',
                'picture' => 'image',
            ]);
            if ($v->fails())
                return redirect()->back()->withInput();
            else{
                $twit = Request::only('content', 'user_id', 'group_id', 'picture', 'link');
                $html_and_rags = $this->doLinkHashTag($twit['content']);
                $link_youtube = ($twit['link'] != null) ? $this->getIframeYouTube($twit['link']) : '';
                $twit['content'] = $html_and_rags['html'] . $link_youtube;
                if(Request::hasFile('picture')) {
                    $file = Request::file('picture');
                    $file->move(public_path() . '/img/twits/' , sha1($twit['picture']) . '.' . Request::file('picture')->getClientOriginalExtension());
                    $twit['picture'] = 'public/img/twits/' . sha1($twit['picture']) . '.' . Request::file('picture')->getClientOriginalExtension();
                }
                if($twit['user_id'])
                    $saver = Auth::user();
                else
                    $saver = Group::find($twit['group_id']);

                $twit = $saver->twits()->create($twit);


                foreach ($html_and_rags['tags'] as $tag)
                    $twit->hash_tags()->create(['name' => $tag]);

                if($twit['user_id'])
                    return redirect('profile/' . Auth::id());
                else
                    return redirect('group/' . $twit['group_id']);

            }
        }
        return redirect()->back();
    }

    public function delete(Twit $twit){

        foreach ($twit->comments as $comment)
            Event::fire(new onDeleteComment($comment));

        $user_has_twit_likes = UserHasTwitLikes::where('twit_id', $twit->id)->get();
        foreach ($user_has_twit_likes as $like)
            foreach ($like->notices as $notice)
                $notice->delete();
        $twit->delete();
    }

    public function repost(Twit $twit){
        $repost = new Twit();
        $param = Request::only('content_share');
        $repost->content = $param['content_share'];
        $repost->created_at = Carbon::now();
        $repost->twit_id = $twit->id;
        Auth::user()->twits()->save($repost);
    }

    public function likes(Twit $twit){

        if (!$twit->users_likes->where('id', Auth::id())->isEmpty())
            die;

        $twit->users_likes()->attach(Auth::user());

        if($twit->user != Auth::user()){
            $last_id = $comment_id = DB::getPdo()->lastInsertId();
            $user_has_twit_likes = UserHasTwitLikes::find($last_id);

            $notice = new Notice();
            $notice->user()->associate($twit->user);
            $user_has_twit_likes->notices()->save($notice);
        }
    }

    public function likesRemove(Twit $twit){
        $user_has_twit_likes = UserHasTwitLikes::where('user_id', Auth::id())->where('twit_id', $twit->id)->get();
        foreach ($user_has_twit_likes as $item)
            foreach ($item->notices as $notice)
                $notice->delete();

        $twit->users_likes()->detach(Auth::user());
    }

    protected function doLinkHashTag($content){
        $hashTag = explode('#', $content);
        $first = array_shift($hashTag);
        $html = $first;
        $tags = [];
        foreach ($hashTag as $ht){
            $inHashTag = explode(' ', $ht);
            $first = array_shift($inHashTag);
            $html .= '<a href="' . route('search.twits') .'?name=' . htmlspecialchars($first) . '">#'.htmlspecialchars($first).' </a>';
            $tags[] = $first;
            foreach ($inHashTag as $in)
                $html .= htmlspecialchars($in);
        }
        return ['html' => $html, 'tags' => $tags];
    }

    protected function getIframeYouTube($link){
        $explode_link = explode('/', $link);
        $iframe = '<iframe width="475" height="270" src="https://www.youtube.com/embed/' . array_pop($explode_link) .'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        return $iframe;
    }

    public function show(Twit $twit){
        //$html = Helper::renderSimpleTwit($twit, $twit->user);

        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        $params = $notice;
        $params['user'] = Auth::user();
        $params['twit'] = $twit;

        return view('twit.show' , $params);
    }

}