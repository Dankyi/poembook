<div class="flex items-center">

    <div class="container mx-auto max-w-3xl">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col break-words bg-blue-200 border border-2 rounded shadow-md">

            <div class="flex justify-between bg-blue-400 py-3 px-6 mb-0">
                <div>
                    <h2 class="text-x1 font-bold mb-2 py-1 px-3">
                        {{ $poem->title }}
                    </h2>
                </div>

                <div>
                    <a href="{{ $poem->path() }}">
                        <button class="fas fa-eye fa-lg bg-blue-500 hover:bg-blue-700 py-2 px-3 rounded">View</button>
                    </a>
                </div>
            </div>

            <div class="w-full p-6">
                <p class="text-justify whitespace-pre-line">
                    @if(strlen($poem->content) > 250)
                        {{ substr($poem->content, 0, 250) }} <a class="font-bold mb-2 text-blue-900" href="{{ $poem->path() }}"> ... Read More</a>
                    @else
                        {{ $poem->content }}
                    @endif
                </p><br/><br/>

                <p>
                    <h3 class="font-bold mb-2">Written By: {{ $poem->user->name }}</h3>
                </p>

                <p>
                    <h3>Published: {{ date('j M Y, H:i', strtotime($poem->created_at)) }}</h3>
                </p>
            </div>
        </div><br/><br/><br/><br/>
    </div>
</div>
