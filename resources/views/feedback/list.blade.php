@extends('app')

@section('title', 'Feedbacks')

@section('body')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Client name</th>
                <th>Client email</th>
                <th>Created at</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
