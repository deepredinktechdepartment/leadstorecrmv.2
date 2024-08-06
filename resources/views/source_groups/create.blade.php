@extends('layouts.app')

@section('title', 'Add Source Group')

@section('content')
<div class="container">

<div class="row">
    <div class="col-4">
    <h1>Add Source Group</h1>
    <form action="{{ route('source_groups.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="source_icon" class="form-label">Source Icon</label>
            <input type="file" name="source_icon" id="source_icon" class="form-control">
            @error('source_icon')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</div>
</div>
@endsection
