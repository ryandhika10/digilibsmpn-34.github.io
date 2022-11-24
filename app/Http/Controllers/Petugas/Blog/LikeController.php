<?php

namespace App\Http\Controllers\Petugas\Blog;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function like($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post_id = $post->id;

        $like = Like::where('post_id', $post_id)->where('user_id', auth()->user()->id)->first();

        if ($like) {
            $like->delete();
            return back();
        } else {
            Like::create([
                'post_id' => $post_id,
                'user_id' => auth()->user()->id,
            ]);
            return back();
        }
    }
}
