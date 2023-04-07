<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResourse;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $post = POST::all();


        return response()->json($post);
    }
    
    public function show(Post $post) {
        return  new PostResourse($post);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'imgpath' => 'required',
            'content' => 'required'
        ]);


        $post = Post::create([
            'title' => $request->title,
            'imgpath' => $request->imgpath,
            'content' => $request->content
        ]);

        return response()->json("Post created");
    }

    public function update(Request $request, Post $post)
    {
        
        $request->validate([
            'title' => 'required',
            'imgpath' => 'required',
            'content' => 'required'
        ]);

        $post->update(
            [
                'title' => $request->title,
                'imgpath' => $request->imgpath,
                'content' => $request->content
            ]
        );

        return response()->json("Post Updated");

    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->json("Post Deleted");

    }
}
