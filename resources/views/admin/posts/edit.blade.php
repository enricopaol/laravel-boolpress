@extends('layouts.app')

@section('tag_title')
    Modifica Post
@endsection

@section('content')
    
    <div class="container">

        <h1>Modifica Post: {{ $post->title }}</h1>

        <p><strong>Post slug:</strong> {{ $post->slug }}</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">                
            </div>

            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Senza categoria</option>

                    @foreach ($categories as $category)

                        <option 
                        value="{{ $category->id }}"                         
                        {{ old('category_id', $post_category_id) == $category->id ? 'selected' : ''}}                     
                        >
                            {{ $category->name }}
                        </option>
                        
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <h6>Tags:</h6>
               
                {{-- {{ dd($post->tags) }} --}}
                @foreach ($tags as $tag)
                    <div class="form-check">
                        @if ($errors->any())
                        <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="checkbox-{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                        @else
                            <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                        @endif
                        
                        <label class="form-check-label" for="checkbox-{{ $tag->id }}">
                            {{$tag->name}}
                        </label>
                    </div>   
                @endforeach

            </div>

            <div class="form-group">
                <label for="cover_img">Carica immagine</label>
                <input type="file" class="form-control-file" id="cover_img" name="cover_img">                
            </div>

            @if ($post->cover)
                <h6>Immagine corrente:</h6>
                <div>
                    <img style="height: 200px; width:auto" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                </div>
            @endif

            <input type="submit" class="btn btn-success" value="Salva le Modifiche">
        </form>
    </div>
@endsection