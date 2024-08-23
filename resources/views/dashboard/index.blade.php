@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

@php
use App\Models\Client;
use App\Models\Lead;
use Carbon\Carbon;

// Count active and inactive clients
$activeClientCount = Client::mappedToUser()->where('active', true)->count();
$inactiveClientCount = Client::mappedToUser()->where('active', false)->count();

// Fetch active and inactive clients
$activeClients = Client::mappedToUser()->where('active', true)->orderby('client_name')->get();
$inactiveClients = Client::mappedToUser()->where('active', false)->orderby('client_name')->get();


// Get the current month
$currentMonth = Carbon::now()->month;

// Define the array to store the counts
$currentMonthLeadsCount = [];

// Retrieve all clients and use the `each` method to populate the array
Client::all()->each(function ($client) use (&$currentMonthLeadsCount, $currentMonth) {
    $currentMonthLeadsCount[$client->id] = Lead::where('client_id', $client->id)
                                                 ->whereMonth('lead_last_update_date', $currentMonth)
                                                 ->count();
});




    // Initialize the performance counters
    $performingWellCount = 0;
    $underperformingCount = 0;
    $meetingExpectationsCount = 0;

    // Retrieve all clients and categorize them based on their performance
    $clients = Client::where('active', true)->get();

    // Use Laravel's collection methods to categorize clients
    $clients->each(function ($client) use (&$performingWellCount, &$underperformingCount, &$meetingExpectationsCount) {
        // Assume you have a method or attribute that returns the monthly count for the client
        $monthlyCount = $client->monthly_count ?? 0; // Replace 'monthly_count' with actual logic or attribute

        // Get the client's specific monthly target or use 250 as the default target
        $monthlyTarget = $client->monthly_target ?? 250;

        if ($monthlyCount > $monthlyTarget) {
            $performingWellCount++;
        } elseif ($monthlyCount < $monthlyTarget) {
            $underperformingCount++;
        } else {
            $meetingExpectationsCount++;
        }
    });

@endphp

<div class="row mb-5">
    <div class="col-sm-3">
        {{-- Card for Active Projects --}}
        <x-card title="Active Projects" :value="$activeClientCount ?? 0" linkUrl="{{ URL::to('clients?active=true') }}" backgroundColor="bg-success" />
    </div>
    <div class="col-sm-3">
        {{-- Card for Performing Well --}}
        <x-card title="Performing Well" :value="$performingWellCount" linkUrl="{{ URL::to('clients?performance=well') }}" backgroundColor="bg-primary" />
    </div>
    <div class="col-sm-3">
        {{-- Card for Underperforming --}}
        <x-card title="Underperforming" :value="$underperformingCount" linkUrl="{{ URL::to('clients?performance=under') }}" backgroundColor="bg-danger" />
    </div>
    <div class="col-sm-3">
        {{-- Card for Meeting Expectations --}}
        <x-card title="Meeting Expectations" :value="$meetingExpectationsCount" linkUrl="{{ URL::to('clients?performance=meeting') }}" backgroundColor="bg-warning" />
    </div>
</div>


@if(Auth::user()->role == 1)
    <!-- Tabs for users with role 1 -->
    <div class="row mb-5">
        <div class="col-lg-12">
            <!-- Tabs Start -->
            <div class="common_tabs">
                <nav class="mb-5">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        @if($activeClientCount > 0)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $activeClientCount > 0 ? 'active' : '' }}"
                                        id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button"
                                        role="tab" aria-controls="active" aria-selected="true">
                                    Active <span class="badge bg-primary ">{{ $activeClientCount }}</span>
                                </button>
                            </li>
                        @endif
                        @if($inactiveClientCount > 0)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $activeClientCount == 0 && $inactiveClientCount > 0 ? 'active' : '' }}"
                                        id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive" type="button"
                                        role="tab" aria-controls="inactive" aria-selected="false">
                                    Inactive <span class="badge bg-danger">{{ $inactiveClientCount }}</span>
                                </button>
                            </li>
                        @endif
                    </ul>
                </nav>
                <div class="tab-content" id="myTabContent">
                    @if($activeClientCount > 0)
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                            <div class="mb-4">
                                <div class="row">
                                    @foreach ($activeClients as $client)
                                        <div class="col-lg-4 mb-2">
                                            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" class="w-100">
                                                @component('components.client-card', [
                                                    'logo' => asset('assets/images/rmc_60.png'),
                                                    'name' => $client->client_name,
                                                    'currentPerformance' => $client->current_performance,
                                                    'targetPerformance' => $client->target_performance,
                                                    'client' => $client,
                                                    'currentMonthLeadsCount' => $currentMonthLeadsCount[$client->id]??0,
                                                    'monthlyTarget' => $client->monthly_target ?? 250
                                                ])
                                                @endcomponent
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($inactiveClientCount > 0)
                        <div class="tab-pane fade {{ $activeClientCount == 0 && $inactiveClientCount > 0 ? 'show active' : '' }}" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                            <div class="mb-4">
                                <div class="row">
                                    @foreach ($inactiveClients as $client)
                                        <div class="col-lg-4 mb-2">
                                            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" class="w-100">
                                                @component('components.client-card', [
                                                    'logo' => asset('assets/images/rmc_60.png'),
                                                    'name' => $client->client_name,
                                                    'currentPerformance' => $client->current_performance,
                                                    'targetPerformance' => $client->target_performance,
                                                    'client' => $client,
                                                    'currentMonthLeadsCount' => $currentMonthLeadsCount[$client->id]??0,
                                                    'monthlyTarget' => $client->monthly_target ?? 250
                                                ])
                                                @endcomponent
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Tabs End -->
        </div>
    </div>
@else
    <!-- For users who are not role 1 -->
    <div class="row mb-5">
        <div class="col-lg-12">
            @if($activeClientCount > 0)
            <div class="mb-4">
                <h5>Active Projects</h5>
                <div class="row mt-2">
                    @foreach ($activeClients as $client)
                        <div class="col-lg-4 mb-2">
                            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" class="w-100">
                                @component('components.client-card', [
                                    'logo' => asset('assets/images/rmc_60.png'),
                                    'name' => $client->client_name,
                                    'currentPerformance' => $client->current_performance,
                                    'targetPerformance' => $client->target_performance,
                                    'client' => $client,
                                    'currentMonthLeadsCount' => $currentMonthLeadsCount[$client->id]??0,
                                    'monthlyTarget' => $client->monthly_target ?? 250
                                ])
                                @endcomponent
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($inactiveClientCount > 0)
            <div class="mb-4">
                <h5>Inactive Projects</h5>
                <div class="row">
                    @foreach ($inactiveClients as $client)
                        <div class="col-lg-4 mb-2">
                            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" class="w-100">
                                @component('components.client-card', [
                                    'logo' => asset('assets/images/rmc_60.png'),
                                    'name' => $client->client_name,
                                    'currentPerformance' => $client->current_performance,
                                    'targetPerformance' => $client->target_performance,
                                    'client' => $client,
                                    'currentMonthLeadsCount' => $currentMonthLeadsCount[$client->id]??0,
                                    'monthlyTarget' => $client->monthly_target ?? 250
                                ])
                                @endcomponent
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
@endif

@if(Auth::user()->role && Auth::user()->role == 1)
    {{-- Login Activity --}}
    @component('components.login-activity')
    @endcomponent
@endif

@endsection
