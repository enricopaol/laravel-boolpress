@extends('layouts.app')

@section('tag_title')
    Boolpress Home
@endsection

@section('content')
    <div class="container text-center">
        <a href="{{ route('index') }}" class="btn btn-primary">Vai al blog</a>

        <a href="{{ route('categories.index') }}" class="btn btn-primary">Naviga per categorie</a>
    </div>
@endsection