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

        $userDislike = $this->userDislikeQuery($poem);
        $dislikesCount = $this->dislikesCount($poem);

        $userFavorite = $this->userFavoriteQuery($poem);
        $favoritesCount = $this->favoritesCount($poem);

        $data = [
            'poem' => $poem,
            'userLike' => $userLike,
            'likesCount' => $likesCount,
            'userDislike' => $userDislike,
            'dislikesCount' => $dislikesCount,
            'userFavorite' => $userFavorite,
            'favoritesCount' => $favoritesCount
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

        $data=[
            'poem' => $poem,
            'userLike' => $userLike,
            'likesCount' => $likesCount
        ];

        return back()->with(['data' => $data]);
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

    public function dislike(Poem $poem)
    {
        $user_id = Auth::id();
        $userDislikeQuery = $this->userDislikeQuery($poem);

        if ($userDislikeQuery < 1) {
            $poem_id = $poem->id;

            $dislike = new Dislike();
            $dislike->user_id = $user_id;
            $dislike->poem_id = $poem_id;

            $dislike->save();

        } elseif ($userDislikeQuery == 1) {
            $this->destroyDislike($poem);
        }

        $userDislike = $this->userDislikeQuery($poem);
        $dislikesCount = $this->dislikesCount($poem);

        $data=[
            'poem' => $poem,
            'userDislike' => $userDislike,
            'dislikesCount' => $dislikesCount
        ];

        return back()->with(['data' => $data]);
    }

    public function userDislikeQuery(Poem $poem)
    {
        $user_id = Auth::id();

        $userDislikeQuery = DB::table('dislikes')
            ->where('user_id', '=', $user_id)
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
        $user_id = Auth::id();

        $userDislikeQuery = DB::table('dislikes')
            ->where('user_id', '=', $user_id)
            ->where('poem_id', '=', $poem->id)
            ->delete();

        return $userDislikeQuery;
    }

    public function favorite(Poem $poem)
    {
        $user_id = Auth::id();
        $userFavoriteQuery = $this->userFavoriteQuery($poem);

        if ($userFavoriteQuery < 1) {
            $poem_id = $poem->id;

            $favorite = new Favorite();
            $favorite->user_id = $user_id;
            $favorite->poem_id = $poem_id;

            $favorite->save();

        } elseif ($userFavoriteQuery == 1) {
            $this->destroyFavorite($poem);
        }

        $userFavorite = $this->userFavoriteQuery($poem);
        $favoritesCount = $this->favoritesCount($poem);

        $data=[
            'poem' => $poem,
            'userFavorite' => $userFavorite,
            'favoritesCount' => $favoritesCount
        ];

        return back()->with(['data' => $data]);
    }

    public function userFavoriteQuery(Poem $poem)
    {
        $user_id = Auth::id();

        $userFavoriteQuery = DB::table('favorites')
            ->where('user_id', '=', $user_id)
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
        $user_id = Auth::id();

        $userFavoriteQuery = DB::table('favorites')
            ->where('user_id', '=', $user_id)
            ->where('poem_id', '=', $poem->id)
            ->delete();

        return $userFavoriteQuery;
    }
}
