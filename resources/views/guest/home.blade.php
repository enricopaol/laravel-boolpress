@extends('layouts.app')

@section('tag_title')
    Boolpress Home
@endsection

@section('content')
    <div class="container text-center">
        <a href="{{ route('blog') }}" class="btn btn-primary">Vai al blog</a>
    </div>
@endsection