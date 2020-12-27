@extends ('layouts.app')

@section ('header')
    <div class="flex justify-center">
        <h1 class="text-3xl font-bold mt-8 mb-5">Add New Poem Form</h1>
    </div>
@endsection

@section ('content')
    <div class="container mx-auto max-w-3xl bg-blue-400 py-3 px-6 mb-0">

        <form method="post" action="/poem/">
            @csrf

            <div>
                <label class="font-semibold">Poem Title:</label>
            </div><br/>
            <div>
                <input class="w-full rounded-lg border-2 p-4 @error ('title') border border-red-500 @enderror"
                       type="text" name="title" data-lpignore="true" autocomplete="off" value="{{ old('title') }}"
                       placeholder="Enter the title of your poem here ..." required/>
            </div><br/><br/>

            @error ('title')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <div>
                <label class="font-semibold">Content:</label>
            </div><br/>
            <div>
                <textarea class="w-full rounded-lg border-2 p-4 text-justify whitespace-pre-line @error ('content') border border-red-500 @enderror"
                          name="content" data-lpignore="true" rows="22" autocomplete="off"
                          placeholder="Enter the content of your poem here ..." required>{{ old('content') }}</textarea>
            </div><br/>

            @error ('content')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <div class="flex justify-end space-x-6">
                <a href="/">
                    <button type="button" class="text-white bg-blue-800 hover:bg-blue-700 py-2 px-4 rounded">Cancel</button>
                </a>

                <button type="submit" class="text-white bg-blue-800 hover:bg-blue-700 py-2 px-4 rounded">Add Poem</button>
            </div>
        </form>
    </div>
@endsection