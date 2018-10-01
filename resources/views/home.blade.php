@extends('main')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row">
            <h1 class="text-center">Welcome

            </h1>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        @if(isset($posts))
                            @foreach($posts as $post)
                                <div class="post">
                                    @if($post->image !== null)
                                        <img src="{{ asset('img/'.$post->image) }}" style="width: 700px; height: 300px;">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" alt="Image Photo" style=" width: 750px; height: 300px; ">
                                    @endif
                                    <h2>{{ $post->title }}</h2>
                                    <p>{{ str_limit($post->body, 260) }}</p>
                                    <a href="{{ url('post/'.$post->id) }}" class="btn btn-primary">Read More </a>
                                    <div class="time">
                                        Posted on {{ $post->created_at }} by {{ $post->user->name }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection