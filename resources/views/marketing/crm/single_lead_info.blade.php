<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<!-- Back Button -->
{{-- <button onclick="window.history.back();" class="btn btn-secondary mb-4">
    <i class="fas fa-arrow-left"></i> Back
</button> --}}

@if(!$error)
    <div class="row">
        <div class="col-md-4">
            @if (!empty($leadData['leads'][0]))
                <div class="card p-3">
                    <h2 class="mb-4">Lead Details</h2>
                    <table class="table table-striped">
                        @foreach($leadData['leads'] as $value)
                            <tr>
                                <th>Fullname</th>
                                <td>{{ $value['firstname'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $value['email'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $value['phone'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>UTM Campaign</th>
                                <td>{{ $value['utm_campaign'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>UTM Medium</th>
                                <td>{{ $value['utm_medium'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>UTM Source</th>
                                <td>{{ $value['utm_source'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>UTM Term</th>
                                <td>{{ $value['utm_term'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>UTM Content</th>
                                <td>{{ $value['utm_content'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>UTM Status</th>
                                <td>{{ $value['status'] ?? 'NA' }}</td>
                            </tr>
                            <tr>
                                <th>Registration Date</th>
                                <td>{{ \Carbon\Carbon::parse($value['registeredon'] ?? 'NA')->format('M d Y') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated On</th>
                                <td>{{ \Carbon\Carbon::parse($value['lead_last_update_date'] ?? 'NA')->format('M d Y') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="alert alert-info">No lead data available.</div>
            @endif
        </div>

        <div class="col-md-2"></div>

        <div class="col-md-4">
            @if (!empty($leadData['conversations']))
                <div class="card p-3">
                    <h2 class="mb-4">Conversations</h2>
                    <ul class="list-group">
                        @foreach($leadData['conversations'] as $value)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ date('M j Y', strtotime($value['addedon'])) }}</span>
                                    <span class="badge bg-info text-dark">Conversation</span>
                                </div>
                                <p class="mt-2">{{ $value['remark'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="alert alert-info">No lead data available.</div>
            @endif
        </div>
    </div>
@else
    @if(!empty($error) && isset($error))
        <div class="alert alert-danger">{{ $error['error'] ?? '' }}</div>
    @endif
@endif

@endsection

@push('scripts')
<!-- Add any scripts here if needed -->
@endpush
