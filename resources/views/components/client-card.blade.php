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

                      <!-- Default Performance Values Display -->
                      <!-- <p class="mb-1">
                        {{ $currentPerformance > 0 ? $currentPerformance : '0' }}/{{ $targetPerformance > 0 ? $targetPerformance : '0' }}
                    </p> -->
                     
                  <!-- Progress Bar -->
                  <!-- <div class="progress ml-3" style="width: 200px;">
                    @php
                        $targetPerformance = $client->target_performance ?? 0;
                        $currentPerformance = $client->current_performance ?? 0;
                        $progress = $targetPerformance > 0 ? ($currentPerformance / $targetPerformance) * 100 : 0;
                        $progressColor = $targetPerformance > 0 ? 'green' : 'red';
                        $progressText = $targetPerformance > 0 ? $progress . '%' : 'N/A';
                    @endphp

                    <div class="progress-bar" role="progressbar"
                        style="width: {{ $progress }}%; background-color: {{ $progressColor }};"
                        aria-valuenow="{{ $progress }}"
                        aria-valuemin="0" aria-valuemax="100">
                        {{ $progressText }} 
                    </div>
                </div> -->
                  <!-- Progress Bar -->
                  <div class="progress ml-3">
                    <div class="progress-bar" role="progressbar"
                        style="width: 50%; background-color: #00ba8b;"
                        aria-valuenow="50%"
                        aria-valuemin="0" aria-valuemax="100">
                        50%
                    </div>
                </div>
                <p class="mb-1 text-end">
                        50/100
                    </p>



            </div>
        </div>
    </div>
</div>
