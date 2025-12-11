@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3>Edit Page: {{ $page->slug }}</h3>
    <form action="{{ route('admin.page.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $page->title }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Content (HTML)</label>
            <textarea name="content" class="form-control" rows="10">{{ $page->content }}</textarea>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
