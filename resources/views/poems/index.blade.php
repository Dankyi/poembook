@extends('layouts.app')

@section ('header')
    <div class="poems-container">
        <div class="text-4xl mb-8">
            <h1 class="h1-styler">Latest Poem Feeds:</h1>
            <a href="/poem/" class="btn-href-styler btn-right-styler">Write New Poem</a>
        </div>
    </div><br/><br/><br/><br/>
@endsection

@section ('content')
    <div>
        @foreach($poems as $poem)
            <div>
                @include('poem_')
            </div>
        @endforeach
    </div>

    <div class="poems-container">
        <div class="pagination-styler">
        {{ $poems->render() }}
        </div>
    </div>
@endsection