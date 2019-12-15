@extends('app')

@section('title', 'Feedbacks')

@section('body')
    {!! Form::open(['url' => '/feedback']) !!}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Client name</th>
                    <th>Client email</th>
                    <th>Created at</th>
                    <th>Processed</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->subject }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ App\User::find($feedback->client_id)->name }}</td>
                        <td>{{ App\User::find($feedback->client_id)->email }}</td>
                        <td>{{ $feedback->created_at }}</td>
                        <td>{{ Form::checkbox(
                            'processed[]',
                            $feedback->id,
                            $feedback->processed
                        ) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ Form::hidden('feedback_ids', $feedback_ids) }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
