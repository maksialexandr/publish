<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 12.02.2018
 * Time: 0:22
 */

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Event;
use Request as FacadeRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request as Request;
use App\Models\Twit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Helpers\Helper;
use App\Models\Comment;
use App\Events\onVisibleNotice;
use App\Models\UserHasFriend;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function index(User $user){
        $twits = $user->twits()->orderBy('id', 'DESC')->limit(5)->offset(0)->get();

        $status = $user->getStatus();
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();

        $params = $notice;
        $params['user'] = $user;
        $params['twits'] = $twits;
        $params['status'] = $status;

        return view('user.index', $params);
    }

    public function getNotice(){
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        Event::fire(new onVisibleNotice($notice['notices_unlooked']));

        $params = $notice;
        $params['user'] = Auth::user();
        return view('user.notice', $params);
    }

    public function getTwitsPaginate(User $user, Request $request){
        $start = $request->input('start');
        $twits = $user->twits()->orderBy('id', 'DESC')->limit(5)->offset($start)->get();
        $js = Helper::renderJS();
        $js .= Helper::renderJStwit();
        $html = '';
        foreach ($twits as $twit) {
            if ($twit->twit_id)
                $html .= Helper::renderRepostTwit($twit, $user);
            else
                $html .= Helper::renderSimpleTwit($twit, $user);
        }
        $flag = (!empty($html)) ? true : false;
        $html .= $js;
        return response()->json(['html' => $html, 'load' => $flag]);
    }

    public function update(Request $request){
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        $params = $notice;

        if (FacadeRequest::isMethod('PUT')){

            $user_from_form = FacadeRequest::only(['id', 'gender', 'phone', 'position', 'status', 'birthday']);
            $user = User::find($user_from_form['id']);
            $user->gender = $user_from_form['gender'];
            $user->phone = $user_from_form['phone'];
            $user->status = $user_from_form['status'];
            $user->position = $user_from_form['position'];
            $user->birthday = $user_from_form['birthday'];

            if(FacadeRequest::hasFile('preview')) {
                $file = FacadeRequest::file('preview');
                $file->move(public_path() . '/preview/' , $user_from_form['id'] . '.' . FacadeRequest::file('preview')->getClientOriginalExtension());
                $user->preview = 'public/preview/' . $user_from_form['id'] . '.' . FacadeRequest::file('preview')->getClientOriginalExtension();
            }

            $user->save();
            $params['msg'] = 'Изменения сохранены !';
            return redirect('profile/'.$user_from_form['id'])->with($params);
        }
        else {
            $params['user'] = Auth::user();
            return view('user.update', $params);
        }
    }

    public function getFriends(User $user){
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        $params = $notice;
        $params['user'] = $user;
        return view('user.friends', $params);
    }

    public function getSubscriber(User $user){
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        $params = $notice;
        $params['user'] = $user;
        return view('user.subscriber', $params);
    }

    public function add(User $user){
        Auth::user()->friends()->attach($user);
        $user->subscribers()->attach(Auth::user());
        $last_id = $comment_id = DB::getPdo()->lastInsertId();
        $user_has_friend = UserHasFriend::find($last_id);

        $notice = new Notice();
        $notice->user()->associate($user);
        $user_has_friend->notices()->save($notice);

    }

    public function delete(User $user){

        $user_has_friend = UserHasFriend::where('user_id', Auth::id())->where('friend_id', $user->id)->get();
        foreach ($user_has_friend as $item)
            foreach ($item->notices as $notice)
                $notice->delete();

        Auth::user()->friends()->detach($user);
        $user->subscribers()->detach(Auth::user());
    }

    public function deletePhoto(User $user){
        $user->preview = null;
        $user->update();
        return redirect()->back();
    }

    public function changePasswordForm(){
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        $params = $notice;
        $params['user'] = Auth::user();
        return view('user.change-password-form', $params);
    }

    public function changePassword(Request $request){
        $validate = Validator::make($request->all(), [
            'current_password' => 'required|',
            'new_password' => 'required|min:6|confirmed',
        ]);
        if ($validate->fails())
            return redirect()->back()->withErrors($validate);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user['password'] = Hash::make($request->new_password);
            $user->update();
            return redirect('/profile/' . Auth::id())->with(['msg' => 'Изменения пароля сохранены !']);
        }
        else
            return redirect()->back();

    }
    public function changeNicknameForm(){
        $notice = Auth::user()->getUnvisibleAndVisibleNotice();
        $params = $notice;
        $params['user'] = Auth::user();
        return view('user.change-nickname-form', $params);
    }

    public function changeNickname(Request $request){
        if($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'nickname' => 'required|min:3|max:255|unique:users,nickname|alpha_dash',
            ], [
                'unique' => 'Данный :attribute уже существует',
                'required' => ':attribute не должен быть пустым',
            ]);

            if ($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);
            else {
                $user = Auth::user();
                $user->nickname = $request->nickname;
                $user->update();
                return redirect('/profile/' . Auth::id())->with(['msg' => 'Изменения никнейма сохранены !<br /> Новый никнейм ' . $user->nickname]);
            }
        }
        return redirect()->back();

    }

}