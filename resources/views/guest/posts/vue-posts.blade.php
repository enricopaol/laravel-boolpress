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

                <div class="col-4 mb-3" v-for="(post, index) in posts">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">@{{ post.title }}</h5>

                            <p>
                                <strong>Categoria:</strong> 
                                <span v-if="post.category"><a :href="`categories/${post.category.slug}`">@{{ post.category.name }}</a></span>
                                <span v-else>nessuna categoria</span>
                            </p>

                            <p>
                                <strong>Tags:</strong> 

                                <span v-if="post.tags.length > 0">
                                    <span v-for="(tag, i) in post.tags">                                   
                                        <span v-if="post.tags.length > 0"><a :href="`tags/${tag.slug}`">@{{ tag.name }}</a><span v-if="i != post.tags.length - 1">, </span></span>
                                    </span>   
                                </span>
                                     
                                <span v-else>nessun tag</span>
                            </p>

                            <p class="card-text">@{{ cutPostDescription(index) }}...</p>
                            <a :href="`blog/${post.slug}`" class="btn btn-primary">Leggi il post</a>
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