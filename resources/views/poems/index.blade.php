@extends('layouts.app')

@section ('header')
    <div class="container mx-auto max-w-3xl">
        @if(session('success'))
            <div class="text-white mt-10 px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <span class="text-xl inline-block mr-5 align-middle">
                <i class="fas fa-check-circle"></i>
            </span>
                <span class="inline-block align-middle mr-8">
                Poem posted successfully!
            </span>
                <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                    <span>×</span>
                </button>
            </div>
        @endif

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

    <script>
        function closeAlert(event){
            let element = event.target;
            while(element.nodeName !== "BUTTON"){
                element = element.parentNode;
            }
            element.parentNode.parentNode.removeChild(element.parentNode);
        }
    </script>
@endsection