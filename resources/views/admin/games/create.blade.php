@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Game</h1>
    </div>
    <form class="form" method="post" action="{{ route('admin.games.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="game">Platform</label>
            <select class="form-control" id="game" name="platform">
                <option disabled selected value> -- select an option -- </option>
                @foreach (config('platforms') as $key=>$platform_id)
                    <option value="{{ $platform_id }}">{{ $key }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

