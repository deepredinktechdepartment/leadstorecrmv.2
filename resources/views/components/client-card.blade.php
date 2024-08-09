<div class="card">
    <div class="row">
        <div class="col-lg-3">
<<<<<<< Updated upstream
            <!-- <img src="assets/images/rmc_60.png" alt="{{ $name }}" class="img-fluid mb-3" width="70px" /> -->


            @if (!empty($client->client_logo) && File::exists(storage_path('app/public/' . $client->client_logo)))
            <img src="{{ URL::to(env('APP_STORAGE').''.$client->client_logo) }}" alt="Client Logo" style="width: 100px; height: auto;">
            @else
            <i class="fas fa-user-circle fa-8x demo_img"></i>
            @endif

=======
            <img src="assets/images/rmc_60.png" alt="{{ $name }}" class="img-fluid mb-3" width="70px" />
            <img src="assets/images/rmc_60.png" alt="{{ $name }}" class="img-fluid mb-3" width="70px" />
            <!-- <i class="fas fa-user-circle fa-8x demo_img"></i> -->
>>>>>>> Stashed changes
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
