@extends('layouts.app')

@section('title', 'Source Groups')

@section('content')
<div class="container">
    <table id="jquery-data-table" class="table table-striped table-hover">
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
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('images/' . $sourceGroup->source_icon) }}" alt="{{ $sourceGroup->name }}" width="50"></td>
                    <td>{{ $sourceGroup->name }}</td>
                    <td>
                        <a href="{{ route('source_groups.edit', Crypt::encrypt($sourceGroup->id)) }}" class="btn btn-warning btn-sm">
                            <i class="{{ config('constants.icons.edit') }}"></i>
                        </a>
                        <form action="{{ route('source_groups.destroy', Crypt::encrypt($sourceGroup->id)) }}" method="POST" class="delete-form" style="display:inline;">
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
