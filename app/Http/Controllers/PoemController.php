<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dislike;
use App\Models\Favorite;
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
        request()->validate([
            'title' => 'required|min:3|max:60',
            'content' => 'required|min:250',
        ]);

        $poem = new Poem();

        $poem->title = $request['title'];
        $poem->content = $request['content'];
        $poem->user_id = Auth::id();

        $poem->save();

        return redirect()->route('index')->with('success', 'success');
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
        ]);

        $poem->update($values);

        return redirect()->route('poem.show', ['poem' => $poem])->with('updated', 'updated');
    }

    public function destroy(Poem $poem)
    {
        $poem->delete();

        return redirect()->route('index');
    }

    public function like(Poem $poem)
    {
        $userLikesCount = $poem->likes()->where('user_id', '=', Auth::id())->count();

        if ($userLikesCount == 0) {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->poem_id = $poem->id;
            $like->save();

        } elseif ($userLikesCount == 1) {
            $poem->likes()->where('user_id', '=', Auth::id())->delete();
        }

        return back();
    }

    public function dislike(Poem $poem)
    {
        $userDislikesCount = $poem->dislikes()->where('user_id', '=', Auth::id())->count();

        if ($userDislikesCount == 0) {
            $dislike = new Dislike();
            $dislike->user_id = Auth::id();
            $dislike->poem_id = $poem->id;
            $dislike->save();

        } elseif ($userDislikesCount == 1) {
            $poem->dislikes()->where('user_id', '=', Auth::id())->delete();
        }

        return back();
    }

    public function favorite(Poem $poem)
    {
        $userFavoritesCount = $poem->favorites()->where('user_id', '=', Auth::id())->count();

        if ($userFavoritesCount == 0) {
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->poem_id = $poem->id;
            $favorite->save();

        } elseif ($userFavoritesCount == 1) {
            $poem->favorites()->where('user_id', '=', Auth::id())->delete();
        }

        return back();
    }

    public function myfavorites()
    {
        $userFavoritePoems = DB::table('favorites')
            ->join('poems', 'poems.id', '=', 'favorites.poem_id')
            ->join('users', 'users.id', '=', 'poems.user_id')
            ->where('favorites.user_id', '=', Auth::id())
            ->paginate(5);

        return view('poems.myfavorites', compact('userFavoritePoems'));
    }

    public function search(Request $request)
    {
        request()->validate([
            'user_input' => 'required',
        ]);

        $userInput = $_GET['user_input'];

        $searchResults = DB::table('users')
            ->join('poems', 'poems.user_id', '=', 'users.id')
            ->where('name', 'LIKE', '%' . $userInput . '%')
            ->orWhere('title', 'LIKE', '%' . $userInput . '%')
            ->orWhere('content', 'LIKE', '%' . $userInput . '%')
            ->paginate(5);

        return view('poems.search-results', compact('searchResults', 'userInput'));
    }

    public function comment(Request $request, Poem $poem)
    {
        request()->validate([
            'comment' => 'required|max:250',
        ]);

        $comment = new Comment();
        $comment->comment = $request['comment'];
        $comment->user_id = Auth::id();
        $comment->poem_id = $poem->id;
        $comment->save();

        return back()->with('comment', 'comment');
    }
}
