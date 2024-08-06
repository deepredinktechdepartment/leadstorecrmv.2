@extends('layouts.app')

@section('title', 'Source Groups')

@section('content')
<div class="container">
    <h1>Source Groups</h1>
    <a href="{{ route('source_groups.create') }}" class="btn btn-primary mb-3">Add New Source Group</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Source Icon</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sourceGroups as $sourceGroup)
                <tr>
                    <td>{{ $sourceGroup->id }}</td>
                    <td><img src="{{ asset('images/' . $sourceGroup->source_icon) }}" alt="{{ $sourceGroup->name }}" width="50"></td>
                    <td>{{ $sourceGroup->name }}</td>
                    <td>
                        <a href="{{ route('source_groups.edit', $sourceGroup->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('source_groups.destroy', $sourceGroup->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
