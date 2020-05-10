<?php

namespace App\Jobs;

use App\Models\Game;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use xPaw\SourceQuery\SourceQuery;

class ProcessServers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param  Game  $gameModel
     * @return void
     */
    public function handle(Game $gameModel)
    {
        $platforms = config('platforms');

        // Retrieve games with at least one server
        $games = $gameModel->with([
            'categories' => function ($query) {
                $query->with('servers');
            }
        ])->with([
            'servers' => function ($query) {
                $query->with('category');
            }
        ])->withCount('servers')->get();

        foreach ($games as $game) {
            if (isset($game->servers)) {
                switch ($game->platform) {
                    case $platforms['Source']:
                        $game->servers = $this->processSourceServers($game->servers);
                        break;
                }
            }
        }

        Cache::put('gameServers', $games, now()->addMinutes(5));
    }

    private function processSourceServers($servers)
    {
        $sourceQuery = new SourceQuery();
        foreach ($servers as $srv) {
            try {
                $sourceQuery->Connect($srv->ip, $srv->port, 5, SourceQuery::SOURCE);
                $srv->info = $sourceQuery->GetInfo();
                $srv->players = $sourceQuery->GetPlayers();
                $srv->rules = $sourceQuery->GetRules();
                $srv->ping = $sourceQuery->Ping();
            } catch (Exception $e) {
                continue;
            } finally {
                $sourceQuery->Disconnect();
            }
        }

        return $servers;
    }
}
