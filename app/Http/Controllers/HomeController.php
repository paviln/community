<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function servers(Game $game)
    {
        if (Cache::has('gameServers')) {
            $games = Cache::get('gameServers');
        } else {
            // Retrieve games with at least one server
            $games = $game->with([
                'categories' => function ($query) {
                    $query->with('servers');
                }
            ])->with([
                'servers' => function ($query) {
                    $query->with('category');
                }
            ])->withCount('servers')->get();
        }

        return view('servers', compact('games'));
    }
}
