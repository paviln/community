@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-around">
    @foreach($servers as $server)
    <div class="col-lg-4">
            <div class="card text-black">
                <div class="card">
                    <img src="https://screenshots.gamebanana.com/img/ss/maps/5036dc3d2b16d.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $server->name }} : {{ $server->info['HostName'] }}</h5>
                        <p class="card-text">Map: {{ $server->info['Map'] }}</p>
                        <p class="card-text">Players: {{ $server->info['Players'].'/'.$server->info['MaxPlayers'] }}</p>
                        <p class="card-text">IP: {{ $server->ip.":".$server->port}}</p>
                        <div class=" text-center">
                            <a href="steam://connect/{{ $server->ip.':'.$server->port}}" class="btn btn-primary">Connect to server</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection