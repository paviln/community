@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Servers</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-success"
                   href="{{ route('admin.servers.create') }}">Add Server</a>
            </div>
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-primary"
                   href="{{ route('admin.games.index') }}">Manage Games</a>
            </div>
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-primary"
                   href="{{ route('admin.categories.index') }}">Manage Categories</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Game</th>
                <th scope="col">Category</th>
                <th scope="col">Ip</th>
                <th scope="col">Port</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($servers as $server)
                <tr>
                    <td class="align-middle">{{ $server->name }}</td>
                    <td class="align-middle">{{ $server->game->name }}</td>
                    <td class="align-middle">{{ $server->category->name }}</td>
                    <td class="align-middle">{{ $server->ip }}</td>
                    <td class="align-middle">{{ $server->port }}</td>
                    <td>
                        <a class="btn btn-primary float-left mr-2" href="{{ route('admin.servers.edit',$server->id)}}">Edit</a>
                        <form class="float-left" action="{{ route('admin.servers.destroy', $server->id)}}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
