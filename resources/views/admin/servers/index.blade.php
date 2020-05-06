@extends('layouts.admin')

@section('content')
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Servers</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-secondary"
                   href="{{ route('admin.servers.create') }}">Create server</a>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Ip</th>
            <th scope="col">Port</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($servers as $server)
            <tr>
                <td>{{ $server->name }}</td>
                <td>{{ $server->ip }}</td>
                <td>{{ $server->port }}</td>
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
@endsection