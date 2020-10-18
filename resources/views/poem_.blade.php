<div class="flex items-center">

    <div class="poems-container">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col break-words bg-blue-200 border border-2 rounded shadow-md">

            <div class="font-semibold bg-blue-400 py-3 px-6 mb-0">
                <h2 class="text-x1 font-bold mb-2">
                    {{ $poem->title }}
                </h2>
            </div>

            <div class="w-full p-6">
                <p style="text-align: justify;white-space: pre-line;">
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

            <div style="position: relative;">
                <div style="display: inline-block;float: left;">
                    <form method="post" action="{{ $poem->path() }}">
                        @method ('DELETE')
                        @csrf
                        <button class="btn-href-styler" style="margin:5px; font-size: 15px;" type="submit"><i class="fas fa-paw mr-2"></i>Delete</button>
                    </form>
                </div>

                <div style="display: inline-block;float: left;">
                    <a href="{{ $poem->path('edit')}}">
                        <button class="btn-href-styler" style="margin:5px; font-size: 15px;" type="button"><i class="fas fa-paw mr-2"></i>Edit</button>
                    </a>
                </div>
            </div>

        </div><br/><br/>
    </div>
</div>
