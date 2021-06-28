@extends('layouts.app')

@section('tag_title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container">

        @include('partials.success-errors-messages')

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


                @if ($post->cover)
                    <div class="img">
                        <img style="height: 150px; width:auto" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                    </div>
                @endif
                

                <p><strong>Post slug: </strong>{{ $post->slug }}</p>

                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Modifica Post</a>

                <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post" style="display: inline-block"> 
                    @csrf
                    @method('DELETE')         

                    <input type="submit" class="btn btn-danger" value="Elimina il Post">
                </form>
              
            </div>
        </div>

    </div>
@endsection