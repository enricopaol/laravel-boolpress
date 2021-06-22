@extends('layouts.app')

@section('tag_title')
    Categorie
@endsection

@section('content')
    <div class="container">

        <h1 class="mb-4">Tutte le categorie</h1>

        <div class="row">
            
            @foreach ($categories as $category)
                <div class="col-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{ ucfirst($category->name) }}</h5>    
                          <p>Totale ricette: {{ count($category->posts) }}</p>                      
                          <a href="{{ route('categories.show', ['slug' => $category->slug]) }}" class="btn btn-primary">Esplora Categoria</a>
                        </div>
                      </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection