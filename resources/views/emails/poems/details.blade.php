@extends ('layouts.email')

@section ('header')
    <h1>PoemBook</h1>
@endsection

@section ('content')
    <p>Hello {{ Auth::user()->name }},</p>

    <p>Below are the details of the poem you requested:</p>

    <p>
        <b>Title: </b>{{ $poem->title }}<br/>
        <b>Content: </b>{{ $poem->content }}<br/>
        <b>Writer: </b>{{ $poem->user->name }}<br/>
        <b>Published: </b>{{ $poem->created_at }}<br/>
    </p>
@endsection
