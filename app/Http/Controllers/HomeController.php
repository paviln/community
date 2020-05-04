<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Server;
use xPaw\SourceQuery\SourceQuery;

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

    public function servers(Server $server, SourceQuery $Query)
    {
        $servers = $server->all();

        foreach ($servers as $server) {
            try {
                $Query->Connect($server->ip, $server->port, 1, SourceQuery::SOURCE);
                $server->info    = $Query->GetInfo();
                $server->players = $Query->GetPlayers();
                $server->rules   = $Query->GetRules();

            } catch (Exception $e) {
                $Exception = $e;
            } finally {

                $Query->Disconnect();
            }
        }

        return view('servers', compact('servers'));
    }
}
