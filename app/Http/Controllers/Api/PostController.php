<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();        

        $result = [];
        foreach($posts as $post) {
            $post_tags_multi_array = $post->tags->toArray();

            $post_tags = [];
            foreach($post_tags_multi_array as $post_tags_array) {
                $post_tags[] = $post_tags_array['name'];
            }
            
            $post = [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'category' => $post->category ? $post->category->name : '',
                'tags' => $post_tags
            ];  
            
            $result[] = $post;
        }

        return response()->json($result);        
    }
}
