<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $poems = Poem::query()->orderByDesc('created_at')->paginate(5);
        //dd($poems);

        return view('poems.index', compact('poems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function show(Poem $poem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function edit(Poem $poem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poem $poem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poem $poem)
    {
        //
    }
}
