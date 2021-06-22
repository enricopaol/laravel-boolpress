<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
     
        $data = [
            'categories' => $categories
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());
        $new_post = $request->all();     

        $post_slug = Str::slug($new_post['title'], '-');
        $base_slug = $post_slug;
        $existing_post_slug = Post::where('slug', '=', $post_slug)->first();
        $counter = 1;

        while($existing_post_slug) {
            $post_slug = $base_slug . '-' . $counter;
            $counter++;
            $existing_post_slug = Post::where('slug', '=', $post_slug)->first();
        }

        $new_post['slug'] = $post_slug;

        $post_to_create = new Post;
        $post_to_create->fill($new_post);        
        $post_to_create->save();

        return redirect()->route('admin.posts.show', ['post' => $post_to_create->id]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post,
            'post_category' => $post->category
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        $data = [
            'post' => $post,
            'post_category_id' => $post->category ? $post->category->id : null,
            'categories' => $categories
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getValidationRules());
        $modified_post = $request->all();

        // Se il titolo del post non cambia, lo slug rimane lo stesso di prima
        $old_post = Post::findOrFail($id);
        $post_slug = Str::slug($modified_post['title'], '-');

        // Se invece cambia, lo slug viene ricontrollato
        if($old_post->title != $modified_post['title']) {
            
            $base_slug = $post_slug;
            $existing_post_slug = Post::where('slug', '=', $post_slug)->first();
            $counter = 1;

            while($existing_post_slug) {
                $post_slug = $base_slug . '-' . $counter;
                $counter++;
                $existing_post_slug = Post::where('slug', '=', $post_slug)->first();
            }
            
        }

        $modified_post['slug'] = $post_slug;        
        $old_post->update($modified_post);

        return redirect()->route('admin.posts.show', ['post' => $old_post->id]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
    }

    public function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:65000',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
}
