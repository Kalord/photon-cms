<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function publish()
    {
        return view('post.create', [
            'categories' => Category::all()
        ]);
    }

    public function create(CreatePostRequest $request)
    {
        return Post::createPost($request->input(), $request->file());
    }

    public function publishUpdate($id)
    {
        return view('post.update', [
            'post' => Post::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function update(CreatePostRequest $request)
    {
        
    }

    public function find(Request $request)
    {
        return Post::findPosts($request->input());
    }

    public function toActive(Request $request)
    {
        return Post::toActive($request->input('id'));
    }

    public function toDraft(Request $request)
    {
        return Post::toDraft($request->input('id'));
    }

    public function toTrash(Request $request)
    {
        return Post::toTrash($request->input('id'));
    }

    public function delete(Request $request)
    {
        return Post::destroy($request->input('id'));
    }
}
