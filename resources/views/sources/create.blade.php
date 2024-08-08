@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6">
    <div class="card m-b-30">
    <div class="card-body">
    <form action="{{ route('sources.store') }}" method="POST">
        @csrf
        <div class="mb-1">
            <label for="source_group_id" class="form-label">Source Group</label>
            <select name="source_group_id" id="source_group_id" class="form-control">
                @foreach($sourceGroups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            @error('source_group_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="shortcode" class="form-label">Shortcode</label>
            <input type="text" name="shortcode" id="shortcode" class="form-control" value="{{ old('shortcode') }}">
            @error('shortcode')
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
