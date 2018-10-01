@extends('main')
@section('title', 'Create Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
              <h1 class="text-center">Create New Post</h1>
                {!! Form::open(['route' => 'post.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>


                <div class="form-group">
                    {{ Form::label('category_id', 'Category') }}
                    {{--{{ Form::select('category_id', $categories, $categories->name, ['class' => 'form-control']) }}--}}
                    <select class="form-control" name="category" id="category">
                        <option value="" selected >Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sub Category -->
                <div class="form-group">
                    {{ Form::label('subcategory', 'SubCategory') }}
                    <select class="form-control" name="subcategory" id="subcategory">
                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status',['0' => 'Disactive', '1' => 'Active'], null,['class' => 'select2-multi form-control','placeholder' => 'Choose Status...'] ) }}
                </div>

                <div class="form-group">
                    {{ Form::label('image', 'Image') }}
                    {{ Form::file('image', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('body', 'Body') }}
                    {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                </div>

                {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#category').on('change',function(e) {
            console.log(e);

            var cat_id = e.target.value;

            // Ajax
            $.get('/ajax-subcat?cat_id=' + cat_id, function (data) {
                // success data
                $('#subcategory').empty();
                $.each(data, function (index, subcatObj) {
                    console.log(subcatObj);
                    $('#subcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
                });
            });


        });

    </script>
@endsection