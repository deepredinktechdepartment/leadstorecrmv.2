@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- DataTable -->
        <table id="clients-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Industry</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $client->client_name }}</td>
                        <td>{{ $client->industry_category }}</td>
                        <td>
                            @if($client->active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $client->address }}</td>
                        <td>
                            <a href="{{ route('clients.edit', ['client' => Crypt::encrypt($client->id)]) }}" class="btn btn-warning btn-sm">
                                <i class="{{ config('constants.icons.edit') }}"></i>
                            </a>
                            <form action="{{ route('clients.destroy', ['client' => Crypt::encrypt($client->id)]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?');">
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
@endsection
@push('scripts')
<script>
    </script>
@endpush
