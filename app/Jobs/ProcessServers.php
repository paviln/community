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

use App\Models\Server;

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
     * @return void
     */
    public function handle(Server $server, SourceQuery $sourceQuery)
    {
        $servers = $server->all();

        foreach ($servers as $srv) {
            try {
                $sourceQuery->Connect($srv->ip, $srv->port, 15, SourceQuery::SOURCE);
                $srv->info = $sourceQuery->GetInfo();
                $srv->players = $sourceQuery->GetPlayers();
                $srv->rules = $sourceQuery->GetRules();
            } catch (Exception $e) {
                echo $e->getMessage();
            } finally {
                $sourceQuery->Disconnect();
            }
        }
        Cache::put('gameServers', $servers, now()->addMinutes(5));
    }
}
