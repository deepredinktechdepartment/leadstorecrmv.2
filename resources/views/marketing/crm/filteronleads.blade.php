<!-- Check if there are any validation errors -->
<!-- Use the Blade directive to check if the form is submitted -->
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
    @php $start_date = old('startDate', $start_date); @endphp
    @php $end_date = old('endDate', $end_date); @endphp
    @php $utm_campaign = old('utmCampaign', $utm_campaign); @endphp
    @php $utm_medium = old('utmMedium', $utm_medium); @endphp
    @php $utm_source = old('utmSource', $utm_source); @endphp
    @php $utm_status = old('utmStatus', $utm_status); @endphp
@endif


<!--
<div class="row">

    <div class="col-12">
        <p class="alert alert-dark"> {!! Config::get('constants.fa-circle-exclamation') !!}  We currently display data from the current month days by default. You can utilize the date filter to retrieve data for specific date ranges.</p>
    </div>
</div>
-->
<div class="row mb-2">
    <div class="col-8 card"> <!-- Added margin-end-3 class for spacing -->
        <form action="{{ route('projectLeads',['projectID'=>Crypt::encrypt($projectID??0)]) }}" method="post">
            @csrf
            <div class="row">
                <!-- From Date -->
                <div class="col-3">
                    <div class="form-group">
                        <label for="start_date">From Date</label>
                        <div class="input-group date" id="datetimepicker1">
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $start_date) }}">
                        </div>
                    </div>
                </div>
                       <div class="col-3">
                    <div class="form-group">
                        <label for="end_date">To Date</label>
                        <div class="input-group date" id="datetimepicker2">
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $end_date) }}">
                        </div>
                    </div>

                </div>
                            <!-- Source -->
                            <div class="col-3">
                                <div class="form-group">
                                    <!-- Select Dropdown for UTM Sources -->
                                    <label for="utm_source">UTM Source:</label>
                                    @php
                                        if (isset($utmData['getUniqueUtmValues']['utm_sources'])) {
                                            $sources = $utmData['getUniqueUtmValues']['utm_sources'];
                                        } else {
                                            $sources = [];
                                        }
                                    @endphp
                                    <select id="utm_source" name="utm_source" class="form-select">
                                        <option value="">UTM Source</option>
                                        @foreach ($sources as $source)
                                            <option value="{{ $source }}" @if ($source == old('utm_source', $utm_source??'')) selected @endif>{{ $source }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                <!-- Medium -->
                <div class="col-3">
                    <div class="form-group">
                        <!-- Select Dropdown for UTM Mediums -->
                        <label for="utm_medium">Medium:</label>
                        @php
                            if (isset($utmData['getUniqueUtmValues']['utm_mediums'])) {
                                $mediums = $utmData['getUniqueUtmValues']['utm_mediums'];
                            } else {
                                $mediums = [];
                            }
                        @endphp
                        <select id="utm_medium" name="utm_medium" class="form-select">
                            <option value="">Medium</option>
                            @foreach ($mediums as $medium)
                                <option value="{{ $medium }}" @if ($medium == old('utm_medium', $utm_medium??'')) selected @endif>{{ $medium }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- To Date -->


    <!-- Campaign -->
    <div class="col-3">
        <div class="form-group">
            <!-- Select Dropdown for UTM Campaigns -->
            <label for="utm_campaign">Campaign:</label>
            @php
                if (isset($utmData['getUniqueUtmValues']['utm_campaigns'])) {
                    $campaigns = $utmData['getUniqueUtmValues']['utm_campaigns'];
                } else {
                    $campaigns = [];
                }
            @endphp
            <select id="utm_campaign" name="utm_campaign" class="form-select">
                <option value="">Campaign</option>
                @foreach ($campaigns as $campaign)
                    <option value="{{ $campaign }}" @if ($campaign == old('utm_campaign', $utm_campaign??'')) selected @endif>{{ $campaign }}</option>
                @endforeach
            </select>
        </div>
    </div>

                <!-- Status -->

                  <div class="col-3">
                  <button type="submit" class="btn btn-primary btn-sm mt-1 mt-4">Search</button>
                 </div>
                <!-- Export Button -->
<div class="col-3">
    <a href="{{ route('exportLeads', [
        'start_date' => $start_date,
        'end_date' => $end_date,
        'utm_source' => $utm_source,
        'utm_medium' => $utm_medium,
        'utm_campaign' => $utm_campaign
    ]) }}" class="btn btn-success btn-sm mt-1 mt-4 text-white">Export</a>
</div>

            </div>




        </form>
    </div>


            <div class="col-4  card">
            <label for="Status">Statistics for Medium</label>
            <div class="row mt-4">
           @if (isset($leadCount_source) && !empty($leadCount_source))
    @foreach ($leadCount_source as $lead)
        <div class="col-12">
            <div class="mr-4 mb-4">
                @if ($lead['utm_source'] === 'Google')
                    <i class="fa-brands fa-square-google-plus fa-2xl" style="color: #db4437;"></i> {{ $lead['lead_count'] }} leads
                @elseif ($lead['utm_source'] === 'Facebook')
                    <i class="fa-brands fa-square-facebook fa-2xl" style="color: #4267b2;"></i> {{ $lead['lead_count'] }} leads
                @elseif ($lead['utm_source'] === 'Twitter')
                    <i class="fa-brands fa-square-twitter fa-2xl" style="color: #1da1f2;"></i> {{ $lead['lead_count'] }} leads
                @elseif ($lead['utm_source'] === 'LinkedIn')
                    <i class="fa-brands fa-linkedin fa-2xl" style="color: #0072b1;"></i> {{ $lead['lead_count'] }} leads
                @elseif ($lead['utm_source'] === 'Website')
                    <i class="fa-brands fa-wpforms fa-flip-horizontal fa-2xl" style="color: #144aa9;"></i> {{ $lead['lead_count'] }} leads
                @endif
            </div>
        </div>
    @endforeach
@endif

            </div>
            </div>

</div>
