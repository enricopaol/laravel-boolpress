<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    public function index() {
        return view('guest.index');
    }

    public function blog() {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('guest.posts.blog', $data);
    }

    public function post($slug) {
        $post = Post::where('slug', '=', $slug)->first();
        
        if(!$post) {
            abort('404');
        }

        $data = [
            'post' => $post
        ];

        return view('guest.posts.post', $data);
    }
}
