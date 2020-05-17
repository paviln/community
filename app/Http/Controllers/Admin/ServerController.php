<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Http\Requests\ServerRequest;
use App\Jobs\ProcessServers;
use App\Models\Server;
use App\Models\Game;


class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::all();

        return view('admin.servers.index', compact('servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::all();
        $categories = Category::all();

        return view('admin.servers.create', compact('games', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServerRequest $request)
    {
        // validate
        $validated = $request->validated();

        // process
        $server = new Server([
            'name' => $validated['name'],
            'ip' => $validated['ip'],
            'port' => $validated['port'],
            'img' => $validated['img'],
            'game_id' => $validated['game_id'],
            'category_id' => $validated['category_id']
        ]);
        $server->save();
        ProcessServers::dispatch();

        return redirect('/admin/servers')->with('success', 'Server created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $server = Server::find($id);
        $games = Game::all();
        $categories = Category::all();

        return view('admin.servers.edit', compact('server', 'games', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServerRequest $request, $id)
    {
        // validate
        $validated = $request->validated();

        // process
        $server = Server::find($id);
        $server->name = $validated['name'];
        $server->ip = $validated['ip'];
        $server->port = $validated['port'];
        $server->img = $validated['img'];
        $server->game_id = $validated['game_id'];
        $server->category_id = $validated['category_id'];
        $server->save();
        ProcessServers::dispatch();

        return redirect('/admin/servers')->with('success', 'Server updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $server = Server::find($id);
        $server->delete();
        ProcessServers::dispatch();

        return redirect('/admin/servers')->with('success', 'Server deleted!');
    }
}
