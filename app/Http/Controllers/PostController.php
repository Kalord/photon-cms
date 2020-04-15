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
}
