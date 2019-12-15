@extends('app')

@section('title', 'Welcome home!')

@section('body')
    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endif
    {!! Form::open(['url' => '/login']) !!}
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
@endsection
