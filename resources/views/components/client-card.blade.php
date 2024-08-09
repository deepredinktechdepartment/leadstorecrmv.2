<div class="card">
    <div class="row">
        <div class="col-lg-3">

            <!-- <img src="assets/images/rmc_60.png" alt="{{ $name }}" class="img-fluid mb-3" width="70px" /> -->


            @if (!empty($client->client_logo) && File::exists(storage_path('app/public/' . $client->client_logo)))
            <img src="{{ URL::to(env('APP_STORAGE').''.$client->client_logo) }}" alt="Client Logo" class="img-fluid client_logo d-block mx-md-auto mb-2">
            @else
            <img src="assets/images/place_holder.png" alt="Client Logo" class="img-fluid client_logo d-block mx-md-auto mb-2">
            @endif


        </div>
        <div class="col-lg-8">
            <div>
                <h6 class="mb-2">{{ $name }}</h6>
                {{-- <p class="mb-1">{{ $client->current_performance }}/{{ $client->target_performance }}</p> --}}
                {{-- <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width:
                    @if ($client->target_performance > 0)
                        {{ ($client->current_performance / $client->target_performance) * 100 }}%
                    @else
                        0%
                    @endif;"
                    aria-valuenow="
                    @if ($client->target_performance > 0)
                        {{ ($client->current_performance / $client->target_performance) * 100 }}
                    @else
                        0
                    @endif"
                    aria-valuemin="0" aria-valuemax="100">
                        @if ($client->target_performance > 0)
                            {{ ($client->current_performance / $client->target_performance) * 100 }}%
                        @else
                            N/A
                        @endif
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
