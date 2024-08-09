<!-- resources/views/components/client-table.blade.php -->
<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-striped table-bordered mt-3 w-100">
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
            @foreach($clients as $client)
                <tr data-client-id="{{ $client->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $client->client_name }}</td>
                    <td>{{ $client->industry_category }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input status-toggle" type="checkbox" data-id="{{ $client->id }}" {{ $client->active ? 'checked' : '' }}>
                            <label class="form-check-label">

                                <span class="badge {{ $client->active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $client->active ? 'Active' : 'Inactive' }}
                                </span>




                            </label>
                        </div>


                    </td>
                    <td>
                        <!-- Edit Icon -->
                        <a href="{{ route('clients.edit', ['client' => Crypt::encrypt($client->id)]) }}" title="Edit Client">
                            <i class="{{ config('constants.icons.edit') }}" aria-label="Edit"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->

                        <!-- Delete Icon -->
                        <form action="{{ route('clients.destroy', ['client' => Crypt::encrypt($client->id)]) }}" method="POST" class="delete-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="no-button"  title="Delete Client">
                                <i class="{{ config('constants.icons.delete') }}" aria-label="Delete"></i>
                            </button>
                        </form>
                        &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->

                        <!-- New Window Icon -->
                        <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" title="Open in New Window">
                            <i class="fas fa-external-link-alt" aria-label="Open in New Window"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp; <!-- Add space between icons -->

                        <!-- Settings Icon -->
                        <a href="{{ route('project.settings', ['projectID' => Crypt::encrypt($client->id)]) }}" title="Settings">
                            <i class="fas fa-cog" aria-label="Settings"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
