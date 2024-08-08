<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-1">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="fullname" id="name" class="form-control" value="{{ old('fullname') }}">
            @error('fullname')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="client_id" id="email" class="form-control" value="{{ old('client_id') }}">
            @error('client_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirm_password" class="form-control">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>User</option>
                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
                <!-- Add other roles as needed -->
            </select>
            @error('role')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="projects" class="form-label">Projects</label>
            @foreach($projects as $project)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="projects[]" value="{{ $project->id }}" id="project_{{ $project->id }}" {{ in_array($project->id, old('projects', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="project_{{ $project->id }}">
                        {{ $project->name }}
                    </label>
                </div>
            @endforeach
            @error('projects')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="profile_photo" class="form-label">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo" class="form-control">
            @error('profile_photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
