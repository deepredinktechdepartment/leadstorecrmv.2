<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

@php
use App\Models\Client;

// Count active and inactive clients
$activeClientCount = Client::where('active', true)->count();
$inactiveClientCount = Client::where('active', false)->count();

// Fetch active and inactive clients
$activeClients = Client::where('active', true)->orderby('client_name')->get();
$inactiveClients = Client::where('active', false)->orderby('client_name')->get();
@endphp

<div class="row mb-5">
    <div class="col-sm-3">
        <div class="card bg-primary p-3">
            <a href="{{ URL::to('clients?active=true') }}">
                <h6 class="text-white mb-2 p-0 m-0 fw-normal">Active Projects</h6>
                <h1 class="text-white display-6 fw-bold p-0 m-0">{{ $activeClientCount ?? 0 }}</h1>
            </a>
        </div>
    </div>
    <!-- Add other cards as needed -->
</div>
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
                          Active
                      </button>
                  </li>
                  @endif
                  @if($inactiveClientCount > 0)
                  <li class="nav-item" role="presentation">
                      <button class="nav-link {{ $activeClientCount == 0 && $inactiveClientCount > 0 ? 'active' : '' }}"
                              id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive" type="button"
                              role="tab" aria-controls="inactive" aria-selected="false">
                          Inactive
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
                                  'targetPerformance' => $client->target_performance
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


{{-- Login Activity --}}
 @component('components.login-activity')

 @endcomponent




@endsection
