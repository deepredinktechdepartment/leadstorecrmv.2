@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="clientTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="inactive-tab" data-bs-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">Inactive</a>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content" id="clientTabsContent">
                    <!-- Active Clients Tab -->
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                        <table id="active-clients-table" class="table table-striped table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Industry</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients->where('active', true) as $client)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->client_name }}</td>
                                        <td>{{ $client->industry_category }}</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>

                                        <td>
                                            <a href="{{ route('clients.edit', ['client' => Crypt::encrypt($client->id)]) }}">
                                                <i class="{{ config('constants.icons.edit') }}"></i>
                                            </a>
                                            &nbsp;
                                            <form action="{{ route('clients.destroy', ['client' => Crypt::encrypt($client->id)]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="no-button" onclick="return confirm('Are you sure you want to delete this client?');">
                                                    <i class="{{ config('constants.icons.delete') }}"></i>
                                                </button>
                                            </form>
                                            &nbsp;
                                            <!-- New Window Icon -->
                                            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" title="Open in New Window">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Inactive Clients Tab -->
                    <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                        <table id="inactive-clients-table" class="table table-striped table-bordered mt-3">
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
                                @foreach($clients->where('active', false) as $client)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $client->client_name }}</td>
                                        <td>{{ $client->industry_category }}</td>
                                        <td>
                                            <span class="badge bg-danger">Inactive</span>
                                        </td>
                                        <td>{{ $client->address }}</td>
                                        <td>
                                            <a href="{{ route('clients.edit', ['client' => Crypt::encrypt($client->id)]) }}">
                                                <i class="{{ config('constants.icons.edit') }}"></i>
                                            </a>
                                            <form action="{{ route('clients.destroy', ['client' => Crypt::encrypt($client->id)]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="no-button" onclick="return confirm('Are you sure you want to delete this client?');">
                                                    <i class="{{ config('constants.icons.delete') }}"></i>
                                                </button>
                                            </form>
                                            <!-- New Window Icon -->
                                            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" title="Open in New Window">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Your JavaScript code here if needed
</script>
@endpush

@push('styles')
<style>
    /* Custom Underline Style for Active Tab */
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #007bff; /* Change color as needed */
    }
</style>
@endpush
