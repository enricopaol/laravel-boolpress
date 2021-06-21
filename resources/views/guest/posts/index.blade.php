@extends('layouts.app')

@section('tag_title')
    Blog
@endsection

@section('content')
    <div class="container">

        <h1 class="mb-4">Tutti i post</h1>

        <div class="row">
            
            @foreach ($posts as $post)
                <div class="col-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{ ucfirst($post->title) }}</h5>
                          <p class="card-text">{{ substr($post->content, 0, 50) }}...</p>
                          <a href="{{ route('show', ['slug' => $post->slug]) }}" class="btn btn-primary">Leggi il post</a>
                        </div>
                      </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection