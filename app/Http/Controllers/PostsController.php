<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::with('user')->orderByDesc('id')->paginate(5);

        return view('index',[
            'posts'=>$posts
        ]);
    }

    public function delete(Request $request,$id){
        $post = Post::find($id);

        if($post->user_id == unserialize(request()->cookie('user'))['id'])
            $post->delete();

        return redirect()->to('/');
    }

    public function single(Request $request,$id){

        $post = Post::find($id);

        return view('single',[
            'post'=>$post
        ]);
    }

    public function create(Request $request){
        if(unserialize(request()->cookie('user'))['auth']) {
            if ($request->method() == 'GET')
                return view('create_post');

            $title = $request->input('title');
            $description = $request->input('description');

            if (empty($title))
                return redirect()->back()->with('error', 'Title is empty');

            if (empty($description))
                return redirect()->back()->with('error', 'Password is empty');

            Post::create([
                'title' => $title,
                'description' => $description,
                'user_id' => unserialize(request()->cookie('user'))['id'],
            ]);
        }
            return redirect()->to('/');

    }

    public function edit(Request $request,$id){
        if(unserialize(request()->cookie('user'))['auth']) {
            $post = Post::find($id);

            if ($request->method() == 'GET') {
                return view('edit_post', [
                    'post' => $post
                ]);
            }

            $title = $request->input('title');
            $description = $request->input('description');

            if (empty($title))
                return redirect()->back()->with('error', 'Title is empty');

            if (empty($description))
                return redirect()->back()->with('error', 'Password is empty');

            $post->update([
                'title' => $title,
                'description' => $description,
            ]);
        }
            return redirect()->back();

    }

}
