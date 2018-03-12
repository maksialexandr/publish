<?php

namespace App\Http\Controllers;
use Request;
use App\Models\Post as Post;
use Illuminate\Http\Response as Response;
use App\Http\Requests as Requests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id', 'DESC')->get();
        $view = view('post.index', array('posts' => $posts))->render();

        return new Response($view);
    }
    public function create(){
        if (Request::isMethod('POST')) {
            $v = Validator::make(Request::all(), [
                'name' => 'required|max:255',
                'content' => 'required',
            ]);
            if ($v->fails())
            {
                return redirect()->back()->withInput();
            }
            else{
                $user = Request::user();
                $post = new Post(Request::only('id', 'name', 'content', 'picture'));

                if(Request::hasFile('picture')) {
                    $file = Request::file('picture');
                    $file->move(public_path() . '/img/posts/' , sha1($post->content) . '.' . Request::file('picture')->getClientOriginalExtension());
                    $post->picture = 'public/img/posts/' . sha1($post->content) . '.' . Request::file('picture')->getClientOriginalExtension();
                }

                $user->posts()->save($post);
                return redirect('/post');
            }
        }
        else{
            return view('/post/create', ['user' => Auth::user()]);
        }
    }
    public function store(){

    }
    public function show(Post $post){

        return view('post.show', ['post' => $post]);
    }
    public function edit(){

    }
    public function update(Post $post){
        if (Request::isMethod('PUT')) {
            $post_update = Request::only('id', 'name', 'content', 'picture');
            $post = Post::find($post_update['id']);
            if(Request::hasFile('picture')) {
                $file = Request::file('picture');
                $file->move(public_path() . '/img/posts/' , sha1($post_update['content']) . '.' . Request::file('picture')->getClientOriginalExtension());
                $post->picture = 'public/img/posts/' . sha1($post_update['content']) . '.' . Request::file('picture')->getClientOriginalExtension();
            }
            $post->name = $post_update['name'];
            $post->content = $post_update['content'];
            $post->save($post_update);
            return redirect()->route('post');
        }
        else
            return view('post.update', array('post' => $post, 'user' => Auth::user()));
    }
    public function destroy(Post $post){
        $post->delete();

        return redirect('/profile/' . Auth::user()->id);
    }
}
