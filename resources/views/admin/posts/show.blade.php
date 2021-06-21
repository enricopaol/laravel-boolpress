@extends('layouts.app')

@section('tag_title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
              <h1>{{ ucfirst($post->title) }}</h1>

              <p>{{ $post->content }}</p>

              <p><strong>Post slug: </strong>{{ $post->slug }}</p>

              <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Modifica Post</a>

              {{-- <a href="#" class="btn btn-danger">Elimina Post</a> --}}
            </div>
          </div>
    </div>
@endsection