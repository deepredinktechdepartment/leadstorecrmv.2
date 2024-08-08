@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-6">
    <div class="card m-b-30">
    <div class="card-body">

    <form action="{{ route('source_groups.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-1">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-1">
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
</div>
@endsection
