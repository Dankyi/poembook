@extends('layouts.app')

@section ('header')
    <div class="container mx-auto max-w-3xl">
        @if (count($searchResults) == 0)
            <div class="flex justify-center">
                <h1 class="text-2xl font-normal mt-5 mb-5">No record matched: "{{ $userInput }}"</h1>
            </div>
        @else
            <div class="flex justify-center">
                <h1 class="text-2xl font-normal mt-5 mb-5">Search results for: "{{ $userInput }}"</h1>
            </div>
        @endif
    </div><br/>

    <div class="flex justify-start container mx-auto max-w-3xl">
        <div>
            <a href="/">
                <button class="text-white fas fa-home focus:outline-none bg-blue-800 hover:bg-blue-700 py-2 px-4 rounded"> Home</button>
            </a>
        </div>
    </div><br/><br/>
@endsection

@section ('content')
    <div>
        @foreach($searchResults as $searchResult)
            <div>
                @include('search_')
            </div>
        @endforeach
    </div>

    <div class="flex justify-center container mx-auto max-w-3xl">
        {{ $searchResults->render() }}
    </div><br/><br/>
@endsection