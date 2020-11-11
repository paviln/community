@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Server</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-danger"
                href="{{ route('admin.servers.index') }}">Go back</a>
            </div>
        </div>
    </div>
    <form class="form" method="post" action="{{ route('admin.servers.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="game">Game</label>
            <select id="game" class="form-control" name="game_id">
                <option disabled selected value> -- select an option --</option>
                @foreach ($games as $game)
                    <option class="{{ str_replace(' ', '_', $game->name) }}" onclick="showCategories(this)"
                            value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="game">Category</label>
            <select class="form-control" id="category" name="category_id">
                <option disabled selected value> -- select an option --</option>
                @foreach ($categories as $category)
                    <option class="{{ str_replace(' ', '_', $category->game->name) }}"
                            value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="ip">Ip</label>
                    <input type="text" class="form-control" name="ip">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="ip">Port</label>
                    <input type="text" class="form-control" name="port">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="ip">Image</label>
            <input type="url" class="form-control" name="img">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

