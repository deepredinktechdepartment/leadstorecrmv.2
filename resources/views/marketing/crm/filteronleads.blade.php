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
                                <!-- To Date -->
                                <div class="form-group">
                                    <label for="end_date">To Date</label>
                                    <div class="input-group date" id="datetimepicker2">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $end_date) }}">
                                    </div>
                                </div>
                            </div>

              <!-- Source -->
              <div class="col-sm-4">
                <div class="form-group">
                    <!-- Select Dropdown for UTM Sources -->
                    <label for="utm_source">UTM Source</label>
                            @php
                            $sources = $utmData['getUniqueUtmValues']['utm_sources'] ?? [];
                        @endphp
                        <select id="utm_source" name="utm_source" class="form-select">
                            <option value="">UTM Source</option>
                            @foreach ($sources as $source)
                                <option value="{{ $source }}" @if ($source == old('utm_source', $utm_source)) selected @endif>{{ $source }}</option>
                            @endforeach
                        </select>
                </div>
                <!-- Campaign -->
                <div class="form-group">
                    <!-- Select Dropdown for UTM Campaigns -->
                    <label for="utm_medium">Medium</label>
                    @php
                    $mediums = $utmData['getUniqueUtmValues']['utm_mediums'] ?? [];
                @endphp
                <select id="utm_medium" name="utm_medium" class="form-select">
                    <option value="">Medium</option>
                    @foreach ($mediums as $medium)
                        <option value="{{ $medium }}" @if ($medium == old('utm_medium', $utm_medium)) selected @endif>{{ $medium }}</option>
                    @endforeach
                </select>
                </div>
            </div>

                     <!-- Medium -->
                     <div class="col-sm-4">
                        <div class="form-group">
                            <!-- Select Dropdown for UTM Mediums -->
                            <label for="utm_campaign">Campaign</label>
                            @php
                            $campaigns = $utmData['getUniqueUtmValues']['utm_campaigns'] ?? [];
                        @endphp
                        <select id="utm_campaign" name="utm_campaign" class="form-select">
                            <option value="">Campaign</option>
                            @foreach ($campaigns as $campaign)
                                <option value="{{ $campaign }}" @if ($campaign == old('utm_campaign', $utm_campaign)) selected @endif>{{ $campaign }}</option>
                            @endforeach
                        </select>
                        </div>
                        <!-- Status -->
                    <div>

                        <button type="submit" class="btn btn-primary btn-sm mt-1 mt-4">Search</button>

                        <a href="{{ route('exportLeads', [
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'utm_source' => $utm_source,
                            'utm_medium' => $utm_medium,
                            'utm_campaign' => $utm_campaign
                        ]) }}" class="btn btn-success btn-sm mt-1 mt-4 text-white">Export</a>
                    </div>
                    </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card h-100 py-3">
                    <label for="Status">Statistics for Medium</label>
                    <div class="row">
                        @if (isset($leadCount_source) && !empty($leadCount_source))
                            @foreach ($leadCount_source as $lead)
                                <div class="col-12">
                                    <div class="mr-4 mb-4">
                                        @php
                                            // Normalize the utm_source to lowercase for comparison
                                            $utmSource = strtolower($lead['utm_source']);
                                            // Determine the correct text based on lead_count
                                            $leadText = $lead['lead_count'] == 1 ? 'lead' : 'leads';
                                        @endphp

                                        @if (preg_match('/^(google|facebook|twitter|linkedin)$/i', $utmSource))
                                            @switch($utmSource)
                                                @case('google')
                                                    <i class="fa-brands fa-square-google-plus fa-2xl" style="color: #db4437;"></i>
                                                    @break
                                                @case('facebook')
                                                    <i class="fa-brands fa-square-facebook fa-2xl" style="color: #4267b2;"></i>
                                                    @break
                                                @case('twitter')
                                                    <i class="fa-brands fa-square-twitter fa-2xl" style="color: #1da1f2;"></i>
                                                    @break
                                                @case('linkedin')
                                                    <i class="fa-brands fa-linkedin fa-2xl" style="color: #0072b1;"></i>
                                                    @break
                                                @default
                                                    <i class="fa-brands fa-wpforms fa-flip-horizontal fa-2xl" style="color: #144aa9;"></i>
                                            @endswitch
                                            {{ $lead['lead_count'] }} {{ $leadText }}
                                        @elseif (preg_match('/^(website|direct)$/i', $utmSource))
                                            <i class="fa-brands fa-wpforms fa-flip-horizontal fa-2xl" style="color: #144aa9;"></i>
                                            {{ $lead['lead_count'] }} {{ $leadText }}
                                        @endif
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
