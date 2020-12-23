@extends('layouts.app')

@section ('header')
    <div class="container mx-auto max-w-3xl">
        <div class="flex justify-start">
            <h1 class="text-3xl font-bold mt-5 mb-5">Selected Poem Details:</h1>
        </div>
        <div class="flex justify-end">
            <button type="button" class="text-white bg-blue-800 hover:bg-blue-700 py-2 px-4 rounded">Email Me Poem</button>
        </div>
    </div><br/><br/>
@endsection

@section ('content')
    <div class="flex items-center">

        <div class="container mx-auto max-w-3xl">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-blue-200 border border-2 rounded shadow-md">

                <div class="bg-blue-400 py-3 px-6 mb-0">
                    <h2 class="text-x1 font-bold mb-2">
                        {{ $poem->title }}
                    </h2>
                </div>

                <div class="w-full p-6">
                    <p class="text-justify whitespace-pre-line">
                        {{ $poem->content }}
                    </p>
                    <br/><br/>
                    <p>
                    <h3 class="font-bold mb-2">
                        Written By: {{ $poem->writer }}
                    </h3>
                    </p>
                    <p>
                    <h3>
                        Published: {{ $poem->created_at }}
                    </h3>
                    </p>
                </div>
            </div><br/><br/>
        </div>
    </div>
@endsection