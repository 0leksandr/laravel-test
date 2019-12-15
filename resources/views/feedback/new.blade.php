@extends('app')

@section('title', 'New feedback')

@section('body')
    @include('component.errors')
    {!! Form::open(['url' => '/feedback']) !!}
        <div class="form-group">
            {{ Form::label('subject', 'Subject') }}
            {{ Form::text('subject', '', ['class' => 'form-control', 'placeholder' => 'Enter subject']) }}
        </div>
        <div class="form-group">
            {{ Form::label('message', 'Message') }}
            {{ Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Enter message']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
@endsection
