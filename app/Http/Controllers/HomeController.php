<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Server;

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

    public function servers(Server $server)
    {
        if (Cache::has('gameServers')) {
            $servers = Cache::get('gameServers');
        } else {
            $servers = $server->all();
        }
        return view('servers', compact('servers'));
    }
}
