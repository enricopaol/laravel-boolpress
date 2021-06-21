<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    public function index() {
        return view('guest.home');
    }

    public function blog() {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('guest.posts.index', $data);
    }

    public function show($slug) {
        $post = Post::where('slug', '=', $slug)->first();
        
        if(!$post) {
            abort('404');
        }

        $data = [
            'post' => $post
        ];

        return view('guest.posts.show', $data);
    }
}
