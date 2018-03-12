<?php

namespace App\Http\Controllers;

use App\Models\Twit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as Http_Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadeRequest;
use App\Http\Requests;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function listGroup(User $user){
        $groups = Group::where('user_id', $user->id)->get();


        return view('group.list', ['user' => $user, 'groups' => $groups]);
    }

    public function show(Group $group){
        $twits = Twit::where('group_id', $group->id)->orderBy('id', 'DESC')->get();


        return view('group.show', ['group' => $group, 'twits' => $twits]);
    }

    public function create(){

        return view('group.create', ['user' => Auth::user()]);
    }

    public function store(){
        $validator = Validator::make(FacadeRequest::all(), [
            'name' => 'required'
        ]);
        if ($validator->fails())
            return redirect()->back()->withInput();
        if (FacadeRequest::isMethod('POST')) {
            $form = FacadeRequest::only(['user_id', 'name']);
            $user = User::find($form['user_id']);
            $group = new Group();
            $group->name = htmlspecialchars($form['name']);

            $salt = sha1($form['name']);
            if (FacadeRequest::hasFile('preview')) {
                $file = FacadeRequest::file('preview');
                $file->move(public_path() . '/preview_group/', $form['user_id'] . $salt . '.' . FacadeRequest::file('preview')->getClientOriginalExtension());
                $group->preview = 'public/preview_group/' . $form['user_id'] .  $salt . '.' . FacadeRequest::file('preview')->getClientOriginalExtension();
            }
            $group = $user->groups()->save($group);
            return redirect('group/' . $group->id);
        }
        else
            return redirect()->back()->withInput();
    }

    public function destroy(Group $group){

        if(Auth::user() == $group->user)
            $group->delete();
    }

}
