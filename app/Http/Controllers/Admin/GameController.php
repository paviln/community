<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Game;
use App\Http\Requests\GameRequest;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        $platforms = array_flip(config('platforms'));

        return view('admin.games.index', compact('games', 'platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        // validate
        $validated = $request->validated();

        // process
        $game = new Game([
            'name' => $validated['name'],
            'platform' => $validated['platform']
        ]);
        $game->save();

        return redirect('/admin/games')->with('success', 'Game added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);

        return view('admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequest $request, $id)
    {
        // validate
        $validated = $request->validated();

        // process
        $game = Game::find($id);
        $game->name = $validated['name'];
        $game->platform = $validated['platform'];
        $game->save();

        return redirect('/admin/games')->with('success', 'Game updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();

        return redirect('/admin/games')->with('success', 'Game deleted!');
    }
}
