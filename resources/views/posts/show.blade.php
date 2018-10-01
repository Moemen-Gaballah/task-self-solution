@extends('main')
@section('title', 'Show Post')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-push-2">
                @if($post->image !== null)
                    <img src="{{ asset('img/'.$post->image) }}" style="width: 750px; height: 300px;">

                @else
                    <img src="{{ asset('img/default.png') }}" alt="Image Photo" style=" width: 750px; height: 300px; ">
                @endif
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->body }}</p>
                <hr>
            </div>
        </div>
    </div>
@endsection