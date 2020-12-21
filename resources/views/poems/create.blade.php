@extends ('layouts.app')

@section ('header')
    <div class="addnew-container">
            <h1 class="h1-styler">Add New Poem Form</h1>
    </div><br/>
@endsection

@section ('content')
    <div class="addnew-container font-semibold bg-blue-400 py-3 px-6 mb-0">

        <form method="post" action="/poem/">
            @csrf

            <label for="title">Poem Title:</label>
            <input class="inputs-styler @error ('title') border border-red-500 @enderror"
                   type="text" name="title" data-lpignore="true" autocomplete="off"
                   placeholder="Enter the title of your poem here.." required/>

            @error ('title')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <label for="content">Content:</label>
            <textarea class="inputs-styler content-styler @error ('content') border border-red-500 @enderror"
                   type="text" name="content" data-lpignore="true" style="height:300px;"
                   autocomplete="off" placeholder="Enter the content of your poem here.." required></textarea>

            @error ('content')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <a href="/">
                <button class="btn-href-styler" type="button">Cancel</button>
            </a>
            <button class="btn-href-styler" type="submit">Add Poem</button>

        </form>
    </div>
@endsection