@extends('layouts.app')

@section('tag_title')
    Vue Posts
@endsection

@section('header_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

@section('content')
    <div class="container">
        {{-- Vue Root --}}
        <div id="root">

            <h1 class="mb-4">Tutti i post</h1>

            <div class="row">    

                <div class="col-4 mb-3" v-for="post in posts">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">@{{ post.title }}</h5>
                            <p class="card-text">@{{ post.content }}...</p>
                            <a href="#" class="btn btn-primary">Leggi il post</a>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>        
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection