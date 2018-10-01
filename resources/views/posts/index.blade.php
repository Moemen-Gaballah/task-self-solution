@extends('main')
@section('title', 'post')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2 style="margin-top: 6px; width: 50%; float:left;">Show Category</h2>
            <a href="{{ url('/post/create') }}" style="float:right;" class="btn btn-primary pull-right">Create New Post</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Image</th>
                    <th>Username</th>
                    <th>SubCategory</th>
                    <th>Status</th>
                    <th>Created_at</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{ str_limit($post->body, 30) }}</td>
                        <td>
                            @if ($post->image !== null)
                                <img src="{{asset('img/'.$post->image)}}" style="width: 80px; height: 80px;">
                            @else
                                No Image!
                            @endif
                        </td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->subcategory->name}}</td>
                        <td>{{$post->status}}</td>
                        <td>{{$post->created_at}}</td>
                        <td>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-success">
                                Show
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            {{ Form::open(['route' => ['post.destroy', $post->id], 'method' => 'DELETE']) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) }}
                            {{ Form::close() }}
                            {{--<a href="{{ route('category.destroy', $cat->id) }}" class="btn btn-xs btn-danger"> Delete</a>--}}
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection