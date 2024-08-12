@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="common_tabs">
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" id="clientTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                            Active <span class="badge bg-success">{{ $clients->where('active', true)->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="inactive-tab" data-bs-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">
                            Inactive <span class="badge bg-danger">{{ $clients->where('active', false)->count() }}</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content" id="clientTabsContent">
                    <!-- Active Clients Tab -->
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                        @component('components.client-table', ['clients' => $clients->where('active', true), 'tableId' => 'active-clients-table'])
                        @endcomponent
                    </div>
                    <!-- Inactive Clients Tab -->
                    <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                        @component('components.client-table', ['clients' => $clients->where('active', false), 'tableId' => 'inactive-clients-table'])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.status-toggle').on('change', function() {
            var clientId = $(this).data('id');
            var isActive = $(this).is(':checked') ? 1 : 0; // Convert boolean to integer

            $.ajax({
                url: '{{ route("clients.updateStatus") }}', // Adjust route as necessary
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: clientId,
                    active: isActive
                },
                success: function(response) {
                    if (response.success) {
                        // Update the label text
                        var row = $('tr[data-client-id="' + clientId + '"]');
                        var statusLabel = row.find('.form-check-label');
                        if (isActive) {
                            statusLabel.text('Active');
                        } else {
                            statusLabel.text('Inactive');
                        }
                        location.reload();
                    } else {
                        alert('Failed to update status');
                        // Reset the toggle switch state on failure
                        $('.status-toggle[data-id="' + clientId + '"]').prop('checked', !isActive);
                    }
                },
                error: function() {
                    alert('An error occurred');
                    // Reset the toggle switch state on error
                    $('.status-toggle[data-id="' + clientId + '"]').prop('checked', !isActive);
                }
            });
        });
    });
</script>
@endpush
