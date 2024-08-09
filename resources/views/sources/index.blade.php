@extends('layouts.app')
@section('title', 'Sources')
@section('content')
<div class="row">
<!-- Start col -->
<div class="col-lg-12">
<div class="card m-b-30">
<div class="card-body">

    <table id="jquery-data-table" class="table table-striped table-bordered mt-3 w-100"">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Source Group</th>
                <th>Name</th>
                <th>Shortcode</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sources as $source)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $source->sourceGroup->name ?? 'N/A' }}</td>
                    <td>{{ $source->name }}</td>
                    <td>{{ $source->shortcode }}</td>
                    <td>
                        <a href="{{ route('sources.edit', $source->id) }}">
                            <i class="{{ config('constants.icons.edit') }}"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->
                        <form  action="{{ route('sources.destroy', $source->id) }}" method="POST"  class="delete-form" style="display:inline;">
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
