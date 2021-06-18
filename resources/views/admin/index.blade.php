@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>    

    @section('tag_title')
        Boolpress Home
    @endsection

    @section('content')
        <div class="container text-center">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Gestisci i Post</a>
        </div>
    @endsection
</div>
@endsection
