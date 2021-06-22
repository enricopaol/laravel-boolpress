@extends('layouts.app')

@section('tag_title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container">        
        <div class="card">
            <div class="card-body">

              <p>
                Categoria: 
                @if ($post_category)
                   <a href="#">{{ $post_category->name }}</a> 
                @else
                    senza categoria 
                @endif                 
              </p>

              <h1>{{ ucfirst($post->title) }}</h1>

              <p>{{ $post->content }}</p>
            </div>
          </div>
    </div>
@endsection