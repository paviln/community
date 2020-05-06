<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Jobs\ProcessServers;
use App\Models\Server;

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
        return view('admin.servers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'ip' => 'required',
            'port' => 'required',
            'img' => 'required',
        ]);

        // process
        $server = new Server([
            'name' => $request->get('name'),
            'ip' => $request->get('ip'),
            'port' => $request->get('port'),
            'img' => $request->get('img')
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
    public
    function edit($id)
    {
        $server = Server::find($id);

        return view('admin.servers.edit', compact('server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function update(Request $request, $id)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'ip' => 'required',
            'port' => 'required',
            'img' => 'required',
        ]);

        // process
        $server = Server::find($id);
        $server->name = $request->get('name');
        $server->ip = $request->get('ip');
        $server->port = $request->get('port');
        $server->img = $request->get('img');
        $server->save();
        ProcessServers::dispatch();

        return redirect('/admin/servers')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $server = Server::find($id);
        $server->delete();
        ProcessServers::dispatch();

        return redirect('/admin/servers')->with('success', 'Contact deleted!');
    }
}
