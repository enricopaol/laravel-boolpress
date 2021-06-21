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
        
        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
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

            <input type="submit" class="btn btn-success" value="Salva le Modifiche">
        </form>
    </div>
@endsection