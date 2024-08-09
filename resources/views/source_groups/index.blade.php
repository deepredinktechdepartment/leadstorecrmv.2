@extends('layouts.app')
@php
use Illuminate\Support\Facades\Storage;
@endphp
@section('content')
<div class="row">
    <div class="col-lg-12">
    <div class="card m-b-30">
    <div class="card-body">
    <table id="jquery-data-table" class="table table-striped table-bordered mt-3 w-100"">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Source Icon</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sourceGroups as $sourceGroup)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>
                        @php
                        // Define the path to the file
                        $filePath = 'public/images/' . $sourceGroup->source_icon;
                        // Check if the file exists
                        $fileExists = Storage::exists($filePath);
                    @endphp

                    <!-- Display the image if it exists -->
                    @if ($fileExists)
                        <div class="mt-2">
                            {{-- <img src="{{ URL::to(asset('storage/app/' . $filePath)) }}" alt="{{ $sourceGroup->name }}" width="50"> --}}
                            <img src="{{ URL::to(asset('storage/app/' . $filePath)) }}"  width="50">
                        </div>
                    @else
                        <!-- Optionally handle the case where the file does not exist -->
                        <div class="mt-2">
                            <p>No image available.</p>
                        </div>
                    @endif

                    </td>
                    <td>{{ $sourceGroup->name }}</td>
                    <td>
                        <a href="{{ route('source_groups.edit', Crypt::encrypt($sourceGroup->id)) }}">
                            <i class="{{ config('constants.icons.edit') }}"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->
                        <form action="{{ route('source_groups.destroy', Crypt::encrypt($sourceGroup->id)) }}" method="POST" class="delete-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="no-button">
                                <i class="{{ config('constants.icons.delete') }}"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
</div>
@endsection
