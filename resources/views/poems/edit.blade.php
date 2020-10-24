@extends ('layouts.app')

@section ('header')
    <div class="addnew-container">
        <div class="divs-on-sides">
            <h1 class="h1-styler">Edit Poem with Title:</h1>
        </div>
        <div class="divs-on-sides">
            <h1 class="h1-styler" style="color: blue;">{{$poem->title}}</h1>
        </div>
    </div><br/><br/>
@endsection

@section ('content')
    <div class="addnew-container font-semibold bg-blue-400 py-3 px-6 mb-0">

        <form method="post" action="{{$poem->path()}}">
            @method ('PATCH')
            @csrf

            <label for="title">Poem Title:</label>
            <input class="inputs-styler @error ('title') border border-red-500 @enderror"
                   type="text" name="title" data-lpignore="true" autocomplete="off"
                   value="{{$poem->title}}" required/>

            @error ('title')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <label for="writer">Written By:</label>
            <input class="inputs-styler @error ('writer') border border-red-500 @enderror"
                   type="text" name="writer" data-lpignore="true" autocomplete="off"
                   value="{{$poem->writer}}" required/>

            @error ('writer')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <label for="content">Content:</label>
            <textarea class="inputs-styler @error ('content') border border-red-500 @enderror"
                      type="text" name="content" data-lpignore="true" style="height:300px"
                      autocomplete="off" required>{{$poem->content}}</textarea>

            @error ('content')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <a href="/">
                <button class="btn-href-styler" type="button">Cancel</button>
            </a>
            <button class="btn-href-styler" type="submit">Update Poem</button>

        </form>
    </div>

@endsection
