@extends('layouts.admin')

@section('content')
@if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a type="button" class="btn btn-sm btn-outline-success"
                   href="{{ route('admin.users.create') }}">Create user</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Admin</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->is_admin }}</td>
                    <td class="align-middle">{{ $user->created_at }}</td>
                    <td class="align-middle">{{ $user->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary float-left mr-2" href="{{ route('admin.users.edit',$user->id)}}">Edit</a>
                        <form class="float-left" action="{{ route('admin.users.destroy', $user->id)}}"
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
