@extends('layouts.app')

@section('title', 'Edit Source Group')

@section('content')
<div class="container">
    <h1>Edit Source Group</h1>
    <form action="{{ route('source_groups.update', $sourceGroup->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="source_icon" class="form-label">Source Icon</label>
            <input type="text" name="source_icon" id="source_icon" class="form-control" value="{{ $sourceGroup->source_icon }}">
            @error('source_icon')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $sourceGroup->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
