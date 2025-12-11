@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px">
        <div style="font-weight:700;font-size:22px">Pages</div>
    </div>

    @if(session('success'))
        <div style="background:#e6f3ea;padding:10px;border-radius:6px;margin-bottom:12px">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slug</th>
                <th>Title</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->slug }}</td>
                <td>{{ $p->title }}</td>
                <td class="text-end">
                    <a href="{{ route('admin.page.edit', $p->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
