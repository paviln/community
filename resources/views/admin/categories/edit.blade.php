@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
    </div>
    <form class="form" method="post" action="{{ route('admin.categories.update', $category->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="game">Game</label>
            <select class="form-control" id="game" name="game_id">
                @foreach ($games as $game)
                    <option @if ($category->game_id === $game->id) selected="selected" @endif value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

