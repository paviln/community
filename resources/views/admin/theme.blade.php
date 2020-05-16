@extends('layouts.admin')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Theme</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-primary" type="submit" form="theme-editor">Save</button>
            </div>
        </div>
    </div>

    <form id="theme-editor" class="form w-100" method="post" action="{{ route('admin.theme.upload') }}"
          enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <textarea id="editor" name="editor">{{ $contents }}</textarea>
        </div>
    </form>

@endsection
