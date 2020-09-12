<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * @param Request $request
     * @set Page $page
     */
    public function __construct(Request $request)
    {
        $this->post = $request->route()->action['model'] ?? null;

        if (!($this->post && $this->post->exists) || $this->post->isDrafted()) {
            abort(404);
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('posts.show')->with([
            'post' => $this->post,
        ]);
    }
}