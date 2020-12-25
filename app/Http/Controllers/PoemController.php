<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Poem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PoemController extends Controller
{
    public function index()
    {
        $poems = Poem::query()->orderByDesc('updated_at')->paginate(5);

        return view('poems.index', compact('poems'));
    }

    public function create()
    {
        return view('poems.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        request()->validate ([
            'title' => 'required|min:3|max:60',
            'content' => 'required|min:250',
        ]);

        $poem = new Poem();

        $poem->title = $request['title'];
        $poem->content = $request['content'];
        $poem->user_id = $user->id;

        $poem->save();

        return redirect()->route('index');
    }

    public function show(Poem $poem)
    {
        $userLike = $this->userLikeQuery($poem);
        $likesCount = $this->likesCount($poem);

        return view('poems.show', compact('poem', 'likesCount', 'userLike'));
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
        ]);

        $poem->update($values);

        return redirect()->route('index');
    }

    public function destroy(Poem $poem)
    {
        $poem->delete();

        return redirect()->route('index');
    }

    public function like(Poem $poem)
    {
        $user_id = Auth::id();
        $userLikeQuery = $this->userLikeQuery($poem);

        if ($userLikeQuery < 1) {
            $poem_id = $poem->id;

            $like = new Like();
            $like->user_id = $user_id;
            $like->poem_id = $poem_id;

            $like->save();

        } elseif ($userLikeQuery == 1) {
            $this->destroyLike($poem);
        }

        $userLike = $this->userLikeQuery($poem);
        $likesCount = $this->likesCount($poem);

        return view ('poems.show', compact ('poem', 'likesCount', 'userLike'));
    }

    public function userLikeQuery(Poem $poem)
    {
        $user_id = Auth::id();

        $userLikeQuery = DB::table('likes')
            ->where('user_id', '=', $user_id)
            ->where('poem_id', '=', $poem->id)
            ->count();

        return $userLikeQuery;
    }

    public function likesCount(Poem $poem)
    {
        $likesCount = DB::table('likes')
            ->where('poem_id', '=', $poem->id)
            ->count();

        return $likesCount;
    }

    public function destroyLike(Poem $poem)
    {
        $user_id = Auth::id();

        $userLikeQuery = DB::table('likes')
            ->where('user_id', '=', $user_id)
            ->where('poem_id', '=', $poem->id)
            ->delete();

        return $userLikeQuery;
    }
}
