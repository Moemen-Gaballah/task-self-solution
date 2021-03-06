@extends('main')
@section('title', 'Edit Category')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <h1 class="text-center">Create New Category</h1>
                {!! Form::model($category, ['route' => ['category.update', $category->id ], 'method' => 'PATCH']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name'); !!}
                    {!! Form::text('name', null, ['class' => 'form-control']); !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description'); !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']); !!}
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status'); !!}
                    {!! Form::select('status',['0' => 'Disactive', '1' => 'Active'], null,['class' => 'select2-multi form-control','placeholder' => 'Choose Status...'] ); !!}
                </div>
                {!! Form::submit('Create', ['class' => 'btn btn-primary']); !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection