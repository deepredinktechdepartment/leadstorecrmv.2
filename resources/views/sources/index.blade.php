@extends('layouts.app')

@section('title', 'Sources')

@section('content')
<div class="container">

    <table id="jquery-data-table" class="table table-striped table-hover">
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
                    <td>{{ $source->id }}</td>
                    <td>{{ $source->sourceGroup->name ?? 'N/A' }}</td>
                    <td>{{ $source->name }}</td>
                    <td>{{ $source->shortcode }}</td>
                    <td>
                        <a href="{{ route('sources.edit', $source->id) }}" class="btn btn-warning btn-sm">
                            <i class="{{ config('constants.icons.edit') }}"></i>
                        </a>
                        <form action="{{ route('sources.destroy', $source->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="{{ config('constants.icons.delete') }}"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
