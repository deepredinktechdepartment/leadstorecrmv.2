@php
    // Initialize variables

    $start_date = $startDate ?? date('Y-m-01');
    $end_date = $endDate ?? date('Y-m-d');
    $utm_campaign = $utmCampaign ?? '';
    $utm_medium = $utmMedium ?? '';
    $utm_source = $utmSource ?? '';
    $utm_status = $utmStatus ?? '';
@endphp

@if (request()->isMethod('post') || request()->isMethod('get'))
    <!-- Form is submitted, use the old function to retrieve the submitted values -->
    @php
        $start_date = old('startDate', $start_date);
        $end_date = old('endDate', $end_date);
        $utm_campaign = old('utmCampaign', $utm_campaign);
        $utm_medium = old('utmMedium', $utm_medium);
        $utm_source = old('utmSource', $utm_source);
        $utm_status = old('utmStatus', $utm_status);
    @endphp
@endif

<section class="bg-web-light pt-3 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="card h-100 py-3">

                    <form action="{{ route('projectLeads', ['projectID' => Crypt::encrypt($projectID ?? 0)]) }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="start_date">From Date</label>
                                    <div class="input-group date" id="datetimepicker1">
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $start_date) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">To Date</label>
                                    <div class="input-group date" id="datetimepicker2">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $end_date) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="utm_source">UTM Source</label>
                                    @php
                                        $sources = $utmData['getUniqueUtmValues']['utm_sources'] ?? [];
                                    @endphp
                                    <select id="utm_source" name="utm_source" class="form-select">
                                        <option value="">--All--</option>
                                        @foreach ($sources as $source)
                                            <option value="{{ $source }}" @if ($source == old('utm_source', $utm_source)) selected @endif>{{ $source }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="utm_medium">Medium</label>
                                    @php
                                        $mediums = $utmData['getUniqueUtmValues']['utm_mediums'] ?? [];
                                    @endphp
                                    <select id="utm_medium" name="utm_medium" class="form-select">
                                        <option value="">--All--</option>
                                        @foreach ($mediums as $medium)
                                            <option value="{{ $medium }}" @if ($medium == old('utm_medium', $utm_medium)) selected @endif>{{ $medium }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="utm_campaign">Campaign</label>
                                    @php
                                        $campaigns = $utmData['getUniqueUtmValues']['utm_campaigns'] ?? [];
                                    @endphp
                                    <select id="utm_campaign" name="utm_campaign" class="form-select">
                                        <option value="">--All--</option>
                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign }}" @if ($campaign == old('utm_campaign', $utm_campaign)) selected @endif>{{ $campaign }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary btn-sm mt-1">Search</button>

                                    <a href="#" id="export-btn" class="btn btn-success btn-sm mt-1 text-white">Export</a>
                                </div>
                            </div>

                        </div>
                    </form>



                </div>
            </div>

            <div class="col-sm-4">
                <div class="card h-100 py-3">
                    <label for="Status">Statistics for Source</label>
                    <div class="row pt-2">
                        @if (isset($leadCount_source) && !empty($leadCount_source))
                        @foreach ($leadCount_source as $lead)
                        <div class="col-12">
                            <div class="mr-4 mb-2">
                                @php
                                    // Normalize the utm_source to lowercase for comparison
                                    $utmSource = strtolower($lead['utm_source'])??'';
                                    // Determine the correct text based on lead_count
                                    $leadText = $lead['lead_count'] == 1 ? 'lead' : 'leads';
                                @endphp

                                <a href="{{ route('projectLeads', ["utm_source"=>$utmSource,'projectID' => Crypt::encrypt($projectID)]) }}">
                                    @if (preg_match('/^(google|facebook|twitter|linkedin)$/i', $utmSource))
                                        @switch($utmSource)
                                            @case('google')
                                                <i class="fa-brands fa-square-google-plus fa-1xl" style="color: #db4437;"></i>
                                                @break
                                            @case('facebook')
                                                <i class="fa-brands fa-square-facebook fa-1xl" style="color: #4267b2;"></i>
                                                @break
                                            @case('twitter')
                                                <i class="fa-brands fa-square-twitter fa-1xl" style="color: #1da1f2;"></i>
                                                @break
                                            @case('linkedin')
                                                <i class="fa-brands fa-linkedin fa-1xl" style="color: #0072b1;"></i>
                                                @break
                                            @default
                                                <i class="fa-brands fa-wpforms fa-flip-horizontal fa-1xl" style="color: #144aa9;"></i>
                                        @endswitch
                                    @elseif (preg_match('/^(website|direct)$/i', $utmSource))
                                        <i class="fa-brands fa-wpforms fa-flip-horizontal fa-1xl" style="color: #144aa9;"></i>
                                    @endif
                                    {{ $lead['lead_count'] }} {{ $leadText }}
                                </a>
                            </div>
                        </div>
                    @endforeach


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')


<script>
    document.getElementById('export-btn').addEventListener('click', function(e) {
        e.preventDefault();

        // Get the current form values
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var utmSource = document.getElementById('utm_source').value;
        var utmMedium = document.getElementById('utm_medium').value;
        var utmCampaign = document.getElementById('utm_campaign').value;

        // Get the projectID
        var projectID = "{{ Crypt::encrypt($projectID ?? 0) }}";

        // Construct the export URL with query parameters
        var exportUrl = "{{ route('exportLeads') }}" +
            '?projectID=' + encodeURIComponent(projectID) +
            '&start_date=' + encodeURIComponent(startDate) +
            '&end_date=' + encodeURIComponent(endDate) +
            '&utm_source=' + encodeURIComponent(utmSource) +
            '&utm_medium=' + encodeURIComponent(utmMedium) +
            '&utm_campaign=' + encodeURIComponent(utmCampaign);

        // Redirect to the constructed URL
        window.location.href = exportUrl;
    });
</script>

@endpush
