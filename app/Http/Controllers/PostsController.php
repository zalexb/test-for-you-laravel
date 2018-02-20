<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderByDesc('id')->paginate(5);

        return view('index',[
            'posts'=>$posts
        ]);
    }

    public function delete(Request $request,$id)
    {
        $post = Post::find($id);

        if($post->user_id == session('user')['id'])
            $post->delete();

        return redirect()->to('/');
    }

    public function single(Request $request,$id)
    {
        $post = Post::find($id);

        return view('single',[
            'post'=>$post
        ]);
    }

    public function create(Request $request)
    {
        if(session('user')['auth'])
        {
            if ($request->method() == 'GET')
                return view('create_post');

            $validatedData = $request->validate([
                'title' => 'required|max:25',
                'description' => 'required|max:2000',
            ]);

            $validatedData['user_id'] = session('user')['id'];

            Post::create($validatedData);
        }
            return redirect()->to('/');

    }

    public function edit(Request $request,$id)
    {
        if(session('user')['auth'])
        {
            $post = Post::find($id);

            if ($request->method() == 'GET')
            {
                return view('edit_post', [
                    'post' => $post
                ]);
            }

            $validatedData = $request->validate([
                'title' => 'required|max:25',
                'description' => 'required|max:2000',
            ]);

            $post->update($validatedData);
        }
            return redirect()->back();

    }

}
