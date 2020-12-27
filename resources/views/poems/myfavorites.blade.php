@extends('layouts.app')

@section ('header')
    <div class="container mx-auto max-w-3xl">
        <div class="flex justify-center">
            <h1 class="text-3xl font-bold mt-5 mb-5">Your Favorite Poems</h1>
        </div>
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
        @foreach($userFavoritePoems as $favoritePoems)
            <div>
                @include('favorites_')
            </div>
        @endforeach
    </div>

    <div class="flex justify-center container mx-auto max-w-3xl">
        {{ $userFavoritePoems->render() }}
    </div><br/><br/>
@endsection