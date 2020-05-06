@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br />
@endif
    <form class="form" method="post" action="{{ route('admin.users.update', $user->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="ip">E-mail</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="ip">Admin</label>
                    <input type="text" class="form-control" name="is_admin" value="{{ $user->is_admin }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

