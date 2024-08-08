@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-6">
    <div class="card m-b-30">
    <div class="card-body">

    <form action="{{ route('source_groups.update', Crypt::encrypt($sourceGroup->id)) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-1">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $sourceGroup->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-1">
            <label for="source_icon" class="form-label">Source Icon</label>

            <input type="file" name="source_icon" id="source_icon" class="form-control">
            @php
            use Illuminate\Support\Facades\Storage;

            // Define the path to the file
            $filePath = 'public/images/' . $sourceGroup->source_icon;



            // Check if the file exists
            $fileExists = Storage::exists($filePath);

        @endphp

        <!-- Display the image if it exists -->
        @if ($fileExists)
            <div class="mt-2">
                <img src="{{ URL::to(asset('storage/app/' . $filePath)) }}" alt="{{ $sourceGroup->name }}" width="100">
            </div>
        @else
            <!-- Optionally handle the case where the file does not exist -->
            <div class="mt-2">
                <p>No image available.</p>
            </div>
        @endif

        <!-- Display validation errors -->
        @error('source_icon')
            <div class="text-danger">{{ $message }}</div>
        @enderror


        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>
</div>
</div>
@endsection
