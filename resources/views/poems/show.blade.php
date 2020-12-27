@extends('layouts.app')

@section ('header')
    <div class="container mx-auto max-w-3xl">
        <div class="flex justify-center">
            <h1 class="text-3xl font-bold mt-5 mb-5">Selected Poem Details:</h1>
        </div>
    </div><br/>

    <div class="flex justify-between container mx-auto max-w-3xl">
        <div>
            <a href="/">
                <button class="text-white fas fa-home focus:outline-none bg-blue-800 hover:bg-blue-700 py-2 px-4 rounded"> Home</button>
            </a>
        </div>
        <div>
            <button type="button" class="text-white focus:outline-none bg-blue-800 hover:bg-blue-700 py-2 px-4 rounded">Email Me Poem</button>
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

            <div class="flex flex-col break-words bg-blue-200 border border-2 rounded shadow-2xl">

                <div class="bg-blue-400 py-3 px-6 mb-0">
                    <h2 class="text-x1 font-bold mb-2">
                        {{ $poem->title }}
                    </h2>
                </div>

                <div class="w-full p-6">
                    <p class="text-justify whitespace-pre-line">
                        {{ $poem->content }}
                    </p><br/><br/>

                    <p>
                    <h3 class="font-bold mb-2">Written By: {{ $poem->user->name }}</h3>
                    </p>

                    <p>
                    <h3>Published: {{ date('j M Y, H:i', strtotime($poem->created_at)) }}</h3>
                    </p>
                </div>

                <div class="bg-blue-400 py-3 px-6 mb-0 flex justify-center space-x-15">
                    @if (Auth::id() == $poem->user_id)
                        <div class="inline-block">
                            <form method="post" action="{{ $poem->path() }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this poem?')">
                                @method ('DELETE')
                                @csrf
                                <button class="focus:outline-none">
                                    <i class="fas fa-trash-alt fa-lg"></i>
                                </button>
                            </form>
                        </div>

                        <div class="inline-block">
                            <a href="{{ $poem->path('edit') }}">
                                <i class="focus:outline-none fas fa-edit fa-lg"></i>
                            </a>
                        </div>
                    @endif

                    <div class="inline-block">
                        <form method="post" action="{{ $poem->path('like') }}">
                            @csrf
                            <button class="focus:outline-none">
                                @if($userLike > 0)
                                    <i class="fa fa-thumbs-up fa-lg"></i>
                                    <span class="text-lg">{{ $likesCount }}</span>
                                @else
                                    <i class="fa fa-thumbs-o-up fa-lg"></i>
                                    <span class="text-lg">{{ $likesCount }}</span>
                                @endif
                            </button>
                        </form>
                    </div>

                    <div>
                        <form method="post" action="{{ $poem->path('dislike') }}">
                            @csrf
                            <button class="focus:outline-none">
                                @if($userDislike > 0)
                                    <i class="fa fa-thumbs-down fa-lg"></i>
                                    <span class="text-lg">{{ $dislikesCount }}</span>
                                @else
                                    <i class="fa fa-thumbs-o-down fa-lg"></i>
                                    <span class="text-lg">{{ $dislikesCount }}</span>
                                @endif
                            </button>
                        </form>
                    </div>

                    <div>
                        <form method="post" action="{{ $poem->path('favorite') }}">
                            @csrf
                            <button class="focus:outline-none">
                                @if($userFavorite > 0)
                                    <i class="fas fa-star fa-lg"></i>
                                    <span class="text-lg">{{ $favoritesCount }}</span>
                                @else
                                    <i class="far fa-star fa-lg"></i>
                                    <span class="text-lg">{{ $favoritesCount }}</span>
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div><br/><br/>
        </div>
    </div>
@endsection