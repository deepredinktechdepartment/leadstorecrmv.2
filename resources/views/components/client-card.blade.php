
<div class="card">
    <div class="row">
        <div class="col-lg-3">
            @if (!empty($client->client_logo) && File::exists(storage_path('app/public/' . $client->client_logo)))
                <img src="{{ URL::to(env('APP_STORAGE').''.$client->client_logo) }}" alt="Client Logo" class="img-fluid client_logo d-block mx-md-auto mb-2">
            @else
                <img src="assets/images/place_holder.png" alt="Client Logo" class="img-fluid client_logo d-block mx-md-auto mb-2">
            @endif
        </div>
        <div class="col-lg-8">
            <div>
                <h6 class="mb-2">{{ $name }}</h6>

                <!-- Progress Bar -->
                <x-progress-bar :currentMonthLeadsCount="$currentMonthLeadsCount" :monthlyTarget="$monthlyTarget" />
                <!--<p class="mb-1 text-end"><small>This month leads: {{ $currentMonthLeadsCount ?? 0 }}/{{$monthlyTarget??0}}</small></p>-->
                  <div class="d-flex justify-content-between align-items-center">
            <p class="mb-1 text-start"><small>This month leads:</small></p>
            <p class="mb-1 text-end"><small>{{ $currentMonthLeadsCount ?? 0 }}/{{ $monthlyTarget ?? 0 }}</small></p>
        </div>

                <!-- Count of Current Month Leads -->
                <!--<p class="mt-3">This month leads: {{ $currentMonthLeadsCount ?? 0 }}</p>-->
            </div>
        </div>
    </div>
</div>