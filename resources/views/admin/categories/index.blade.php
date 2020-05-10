@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
        <div class="btn-group mr-2">
            <a type="button" class="btn btn-sm btn-outline-secondary"
               href="{{ route('admin.categories.create') }}">Add Category</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Game</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->game->name }}</td>
                <td>
                    <a class="btn btn-primary float-left mr-2" href="{{ route('admin.categories.edit',$category->id) }}">Edit</a>
                    <form class="float-left" action="{{ route('admin.categories.destroy',$category->id) }}"
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
