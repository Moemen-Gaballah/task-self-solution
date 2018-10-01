@extends('main')
@section('title', 'Create Category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Category</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
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
                            {!! Form::select('status',['0' => 'Disactive', '1' =>'Active'], null,['class' => 'form-control','placeholder' => 'Choose Status...'] ); !!}
                        </div>
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']); !!}
                        {!! Form::close() !!}
                    </div>
                {{--<div class="col-md-8 col-md-push-2">--}}
                {{--<h1 class="text-center">Create New Category</h1>--}}

                </div>
            </div>
        </div>
    </div>
@endsection
