<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;
use App\Mail\SendNewPostNotification;

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
        $tags = Tag::all();
     
        $data = [
            'categories' => $categories,
            'tags' => $tags
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

        // Upload Image
        if(isset($new_post['cover_img'])) {
            $img_path = Storage::put('posts-cover', $new_post['cover_img']);
            
            if($img_path) {
                $new_post['cover'] = $img_path;
            }
        }

        $post_to_create = new Post;
        $post_to_create->fill($new_post);        
        $post_to_create->save();


        // Tags
        if(isset($new_post['tags'])) {
            $post_to_create->tags()->sync($new_post['tags']);
        }

        // Send Notification Mail for the admin
        Mail::to('paolazzienrico@gmail.com')->send(new SendNewPostNotification($post_to_create));

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
            'post_category' => $post->category,
            'post_tags' => $post->tags
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
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'post_category_id' => $post->category ? $post->category->id : null,
            'categories' => $categories,
            'tags' => $tags
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
        
        // Upload image
        if(isset($modified_post['cover_img'])) {
            $img_path = Storage::put('posts-cover', $modified_post['cover_img']);
            
            if($img_path) {
                $modified_post['cover'] = $img_path;
            }
        }

        // Update All fillables
        $old_post->update($modified_post);

        // Tags Many to Many with Sync()
        if(isset($modified_post['tags'])) {
            $old_post->tags()->sync($modified_post['tags']);
        } else {
            $old_post->tags()->sync([]);
        }

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

        // Per evitare righe orfane cancello prima tutte le istanze tag collegate al post
        $post_to_delete->tags()->sync([]);

        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
    }

    public function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:65000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array|exists:tags,id',
            'cover_img' => 'nullable|image|max:3000'
        ];
    }
}
