<?php

namespace App\Http\Controllers;

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

        return redirect()->route('index');
    }

    public function show(Poem $poem)
    {
        $data = [
            'poem' => $poem,
            'userLike' => $this->userLikeQuery($poem),
            'likesCount' => $this->likesCount($poem),
            'userDislike' => $this->userDislikeQuery($poem),
            'dislikesCount' => $this->dislikesCount($poem),
            'userFavorite' => $this->userFavoriteQuery($poem),
            'favoritesCount' => $this->favoritesCount($poem)
        ];

        return view('poems.show', $data);
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

        return redirect()->route('poem.show', ['poem' => $poem]);
    }

    public function destroy(Poem $poem)
    {
        $poem->delete();

        return redirect()->route('index');
    }

    public function like(Poem $poem)
    {
        if ($this->userLikeQuery($poem) < 1) {
            $poem_id = $poem->id;

            $like = new Like();
            $like->user_id = Auth::id();
            $like->poem_id = $poem_id;

            $like->save();

        } elseif ($this->userLikeQuery($poem) == 1) {
            $this->destroyLike($poem);
        }

        return back();
    }

    public function userLikeQuery(Poem $poem)
    {
        $userLikeQuery = DB::table('likes')
            ->where('user_id', '=', Auth::id())
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
        $userLikeQuery = DB::table('likes')
            ->where('user_id', '=', Auth::id())
            ->where('poem_id', '=', $poem->id)
            ->delete();

        return $userLikeQuery;
    }

    public function dislike(Poem $poem)
    {
        if ($this->userDislikeQuery($poem) < 1) {
            $poem_id = $poem->id;

            $dislike = new Dislike();
            $dislike->user_id = Auth::id();
            $dislike->poem_id = $poem_id;

            $dislike->save();

        } elseif ($this->userDislikeQuery($poem) == 1) {
            $this->destroyDislike($poem);
        }

        return back();
    }

    public function userDislikeQuery(Poem $poem)
    {
        $userDislikeQuery = DB::table('dislikes')
            ->where('user_id', '=', Auth::id())
            ->where('poem_id', '=', $poem->id)
            ->count();

        return $userDislikeQuery;
    }

    public function dislikesCount(Poem $poem)
    {
        $dislikesCount = DB::table('dislikes')
            ->where('poem_id', '=', $poem->id)
            ->count();

        return $dislikesCount;
    }

    public function destroyDislike(Poem $poem)
    {
        $userDislikeQuery = DB::table('dislikes')
            ->where('user_id', '=', Auth::id())
            ->where('poem_id', '=', $poem->id)
            ->delete();

        return $userDislikeQuery;
    }

    public function favorite(Poem $poem)
    {
        if ($this->userFavoriteQuery($poem) < 1) {
            $poem_id = $poem->id;

            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->poem_id = $poem_id;

            $favorite->save();

        } elseif ($this->userFavoriteQuery($poem) == 1) {
            $this->destroyFavorite($poem);
        }

        return back();
    }

    public function userFavoriteQuery(Poem $poem)
    {
        $userFavoriteQuery = DB::table('favorites')
            ->where('user_id', '=', Auth::id())
            ->where('poem_id', '=', $poem->id)
            ->count();

        return $userFavoriteQuery;
    }

    public function favoritesCount(Poem $poem)
    {
        $favoritesCount = DB::table('favorites')
            ->where('poem_id', '=', $poem->id)
            ->count();

        return $favoritesCount;
    }

    public function destroyFavorite(Poem $poem)
    {
        $userFavoriteQuery = DB::table('favorites')
            ->where('user_id', '=', Auth::id())
            ->where('poem_id', '=', $poem->id)
            ->delete();

        return $userFavoriteQuery;
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
}
