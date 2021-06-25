<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();        

        $result_response = [];
        foreach($posts as $post) {
            $post_tags_multi_array = $post->tags->toArray();

            $post_tags = [];
            foreach($post_tags_multi_array as $post_tags_array) {
                $post_tags[] = [
                    'name' => $post_tags_array['name'],
                    'slug' => $post_tags_array['slug']
                ];
            }

            $post_category_instance = $post->category ? $post->category->toArray() : null;

            if (is_array($post_category_instance)) {
                $post_category = Arr::where($post_category_instance, function($value, $key) {
                    return $key == 'name' || $key == 'slug';
                });   
            } else {
                $post_category = $post_category_instance;
            }                             
            
            $result_response[] = [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'category' => $post_category,
                'tags' => $post_tags,
                'slug' => $post->slug
            ];                          
        }

        $result = [
            'posts' => $result_response
        ];

        return response()->json($result);        
    }
}
