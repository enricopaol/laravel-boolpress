@extends('layouts.app')

@section('tag_title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container">        
        <div class="card">
            <div class="card-body">

              <p>
                <strong>Categoria</strong>: 
                
                @if ($post_category)
                   <a href="{{ route('categories.show', ['slug' => $post_category->slug]) }}">{{ $post_category->name }}</a> 
                @else
                    senza categoria 
                @endif                 
              </p>

              <p>
                <strong>Tags</strong>: 
                
                @if ($post_tags->isNotEmpty())                    
                    @foreach ($post_tags as $tag)
                        <a href="{{ route('tags.show', ['slug' => $tag->slug]) }}">{{ $tag->name }}</a>{{ !$loop->last ? ', ' : ''}}
                    @endforeach                       
                @else
                    nessun tag
                @endif                 
              </p>

              <h1>{{ ucfirst($post->title) }}</h1>

              <p>{{ $post->content }}</p>
            </div>
          </div>
    </div>
@endsection