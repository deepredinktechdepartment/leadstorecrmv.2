<div class="card">
    <div class="row">
        <div class="col-lg-3">
            <img src="https://leadstore.in/clientlogos/2017-12-04_(1).png" alt="{{ $name }}" class="img-fluid mb-3" width="70px" />
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