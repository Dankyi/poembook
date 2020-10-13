@extends('layouts.app')

@section ('content')

    <div>
        @foreach($poems as $poem)

            <div>
                @include('poem_')
            </div>

        @endforeach
    </div>

    <div class="poems-container">
        <div style="width: 40%;margin-right: auto;">
        {{$poems->render()}} <!-- put pagination into effect by using Laravel 8 default render method -->
        </div>
    </div>

@endsection
