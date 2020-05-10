@extends('layouts.site')

@section('content')
    <div class="container">
        <h1 class="text-center">Servers</h1>
        <?php dump($games); ?>
        @foreach ($games as $game)
            @if($game->servers_count)
                <h3 class="mt-3">{{ $game->name }}</h3>
                <div class="d-flex justify-content-center">
                    <ul class="{{ str_replace(' ', '_', $game->name) }}">
                        <li class="btn btn-light" value="all" onclick="filterCategory(this)">All</li>
                        @foreach ($game->categories as $category)
                            @if (count($category->servers))
                                <li class="btn btn-light"
                                    value="{{ str_replace(' ', '_', $category->name) }}"
                                    onclick="filterCategory(this)">{{ $category->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row justify-content-around">
                @foreach ($game->servers as $server)
                    <div
                        class="col-lg-4 {{ str_replace(' ', '_', $game->name) }} {{ str_replace(' ', '_', $server->category->name) }}">
                        <div
                            class="card text-black">
                            <div class="card">
                                <img src="{{ $server->img }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $server->name }}</h5>
                                    <p class="card-text">Map: {{ $server->info['Map'] }}</p>
                                    <p class="card-text">
                                        Players: {{ $server->info['Players'].'/'.$server->info['MaxPlayers'] }}</p>
                                    <p class="card-text">IP: {{ $server->ip.":".$server->port }}</p>
                                    <p class="card-text">
                                        Status:
                                        @if ($server->ping)
                                            Online
                                        @else
                                            Ofline
                                        @endif
                                    </p>
                                    <div class=" text-center">
                                        <a href="steam://connect/{{ $server->ip.':'.$server->port}}"
                                           class="btn btn-primary">Connect to server</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php dump($server); ?>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
