<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    public function index()
    {
        $poems = Poem::query()->orderByDesc('created_at')->paginate(5);

        return view('poems.index', compact('poems'));
    }

    public function create()
    {
        return view('poems.create');
    }

    public function store(Request $request)
    {
        request()->validate ([
            'title' => 'required',
            'content' => 'required',
            'writer' => 'required|min:2|max:32',
        ]);

        $poem = new Poem();

        $poem->title = $request['title'];
        $poem->content = $request['content'];
        $poem->writer = $request['writer'];

        $poem->save();

        return redirect()->route('index');
    }

    public function show(Poem $poem)
    {
        return view('poems.show', compact('poem'));
    }

    public function edit(Poem $poem)
    {
        return view('poems.edit', compact('poem'));
    }

    public function update(Request $request, Poem $poem)
    {
        $values = request()->validate ([
            'title' => 'required|min:2|max:60',
            'content' => 'required',
            'writer' => 'required|min:2|max:32',
        ]);

        $poem->update($values);

        return redirect()->route('index');
    }

    public function destroy(Poem $poem)
    {
        $poem->delete();

        return redirect()->route('index');
    }
}
