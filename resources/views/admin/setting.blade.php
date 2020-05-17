@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Settings</h1>
    </div>
    @foreach($settings as $setting)
        <form class="form" method="post" action="{{ route('admin.setting.update', $setting->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Application name</label>
                <input type="text" class="form-control" name="value" value="{{ $setting->value }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endforeach
@endsection
