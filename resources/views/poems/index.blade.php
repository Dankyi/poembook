@extends('layouts.app')

@section ('header')
    <div class="poems-container">
        <div class="text-4xl mb-8">
            <h1 style="text-align:left;float:left;">Latest Poem Feeds:</h1>
            <a href="/poem/" class="btn-href-styler" style="text-align:right;float:right;">Write New Poem</a>
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
        <div style="width: 50%;margin-right: auto;">
        {{$poems->render()}} <!-- put pagination into effect by using Laravel 8 default render method -->
        </div>
    </div>

@endsection
