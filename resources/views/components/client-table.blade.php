<!-- resources/views/components/client-table.blade.php -->
<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-striped table-bordered mt-3 w-100">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Industry</th>
                @if(Auth::user()->role && Auth::user()->role==1)
                <th>Status</th>
                @endif
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr data-client-id="{{ $client->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" title="Open in New Window">{{ $client->client_name }}</a></td>
                    <td>{{ $client->industry_category }}</td>
                    @if(Auth::user()->role && Auth::user()->role==1)
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
                    @endif
                    <td>
                        @if(Auth::user()->role && Auth::user()->role==1)
                        <!-- Edit Icon -->
                        <a href="{{ route('clients.edit', ['client' => Crypt::encrypt($client->id)]) }}" title="Edit Client">
                            <i class="{{ config('constants.icons.edit') }}" aria-label="Edit"></i>
                        </a>
                        @endif
                        @if(Auth::user()->role && Auth::user()->role==1)
                        &nbsp;&nbsp; <!-- Add space between icons -->

                        <!-- Delete Icon -->
                        <form action="{{ route('clients.destroy', ['client' => Crypt::encrypt($client->id)]) }}" method="POST" class="delete-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="no-button"  title="Delete Client">
                                <i class="{{ config('constants.icons.delete') }}" aria-label="Delete"></i>
                            </button>
                        </form>
                        @endif

                        &nbsp;&nbsp; <!-- Add space between icons -->



                        @if(Auth::user()->role && Auth::user()->role==1)
                        &nbsp;&nbsp; <!-- Add space between icons -->

                        <!-- Settings Icon -->
                        <a href="{{ route('project.settings', ['projectID' => Crypt::encrypt($client->id)]) }}" title="Settings">
                            <i class="fas fa-cog" aria-label="Settings"></i>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
