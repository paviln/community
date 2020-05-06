@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Server</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif
    <form class="form" method="post" action="{{ route('admin.servers.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
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

