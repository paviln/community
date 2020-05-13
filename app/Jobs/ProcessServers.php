<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

use xPaw\SourceQuery\SourceQuery;

use App\Models\Game;


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
        // Get all servers sorted as games with categories.
        $games = $gameModel->with([
            'categories' => function ($query) {
                $query->with('servers');
            }
        ])->get();

        // Remove categories with no servers.
        foreach ($games as $game_id => $game) {
            $has_server = false;
            foreach ($game->categories as $category_id => $category) {
                if (!count($category->servers)) {
                    unset($game->categories[$category_id]);
                } else {
                    $has_server = true;
                }
            }
            if (!$has_server) {
                unset($games[$game_id]);
            }
        }

        // Config supported platforms.
        $platforms = config('platforms');

        // Query servers to specific platform.
        foreach ($games as $game) {
            foreach ($game->categories as $categories) {
                switch ($game->platform) {
                    case $platforms['Source']:
                        $categories->servers = $this->processSourceServers($categories->servers);
                        break;
                }
            }
        }

        // Save game servers in cache for 5 minutes.
        Cache::put('gameServers', $games, now()->addMinutes(5));
    }

    /**
     * Process source servers, using SourceQuery.
     *
     * @param $servers
     * @return mixed
     */
    private function processSourceServers($servers)
    {
        $sourceQuery = new SourceQuery();
        foreach ($servers as $server) {
            try {
                $sourceQuery->Connect($server->ip, $server->port, 5, SourceQuery::SOURCE);
                $server->info = $sourceQuery->GetInfo();
                $server->players = $sourceQuery->GetPlayers();
                $server->rules = $sourceQuery->GetRules();
                $server->ping = $sourceQuery->Ping();
            } catch (Exception $e) {
                continue;
            } finally {
                $sourceQuery->Disconnect();
            }
        }
        return $servers;
    }
}
