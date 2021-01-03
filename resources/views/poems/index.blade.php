@extends('layouts.app')

@section ('header')
    <div class="container mx-auto max-w-3xl">
        <div>
            <h1 class="text-3xl font-bold mt-5 mb-5">Latest Poem Feeds:</h1>
        </div>
        <div class="flex justify-end">
            <a href="/poem/" class="text-white bg-blue-800 focus:outline-none hover:bg-blue-700 py-2 px-4 rounded">Write New Poem</a>
        </div>
    </div><br/><br/>
@endsection

@section ('content')
    <div>
        @if($poems->count() > 0)
            @foreach($poems as $poem)
                <div>
                    @include('poem_')
                </div>
            @endforeach
        @else
            <div class="flex justify-center"><h1 class="text-2xl font-thin mt-5 mb-5">There are no poem feeds ...</h1></div>
        @endif
    </div>

    <div class="flex justify-center container mx-auto max-w-3xl">
        {{ $poems->render() }}
    </div><br/><br/>
@endsection