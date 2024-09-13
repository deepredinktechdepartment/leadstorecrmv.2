@extends('layouts.app')

@section('content')
<div class="row justify-content-left">


    <div class="col-md-8">

        <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($projectID ?? 0)]) }}" class="no-button"><u>Back to Leads</u></a>
        <!-- Bootstrap Card -->
        <div class="card">
            <div class="card-body">
                <!-- Lead Form -->
                <form action="{{ isset($lead) ? route('leads.update', $lead->id) : route('leads.store') }}" method="POST">
                    @csrf
                    @if(isset($lead))
                        @method('PUT')
                    @endif

                    <!-- Form Fields for Lead Data -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $lead->first_name ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $lead->last_name ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $lead->email ?? '') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $lead->phone_number ?? '') }}" required>
                            </div>
                        </div>

                        <!-- UTM Parameters Input Fields -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="utm_source">UTM Source</label>
                                <input type="text" name="utm_source" id="utm_source" class="form-control" value="{{ old('utm_source', $lead->utm_source ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="utm_medium">UTM Medium</label>
                                <input type="text" name="utm_medium" id="utm_medium" class="form-control" value="{{ old('utm_medium', $lead->utm_medium ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="utm_campaign">UTM Campaign</label>
                                <input type="text" name="utm_campaign" id="utm_campaign" class="form-control" value="{{ old('utm_campaign', $lead->utm_campaign ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="utm_term">UTM Term</label>
                                <input type="text" name="utm_term" id="utm_term" class="form-control" value="{{ old('utm_term', $lead->utm_term ?? '') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="utm_content">UTM Content</label>
                                <input type="text" name="utm_content" id="utm_content" class="form-control" value="{{ old('utm_content', $lead->utm_content ?? '') }}">
                            </div>
                        </div>

                        <!-- UDF Fields -->
                        <fieldset>
                            <legend>UDF Fields</legend>
                            @for($i = 1; $i <= 5; $i++)
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="udf_label{{ $i }}">UDF{{ $i }} Label</label>
                                            <input type="text" name="udf_label{{ $i }}" id="udf_label{{ $i }}" class="form-control" value="{{ old('udf_label'.$i, $lead->{'udf_label'.$i} ?? '') }}" placeholder="Enter label for UDF{{ $i }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="udf_value{{ $i }}">UDF{{ $i }} Value</label>
                                            <input type="text" name="udf_value{{ $i }}" id="udf_value{{ $i }}" class="form-control" value="{{ old('udf_value'.$i, $lead->{'udf_value'.$i} ?? '') }}" placeholder="Enter value for UDF{{ $i }}">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </fieldset>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $lead->date ?? '') }}" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($lead) ? 'Update Lead' : 'Create Lead' }}
                    </button>



                    <!-- Hidden input for source URL -->
                    <input type="hidden" name="source_url" id="source_url_hidden" value="{{ env('APP_URL').'manualCreateLead?projectID=<projectId>' }}" required />
                    <input type="text" name="country_code" id="country_code" value="91" required>
                    <input type="hidden" name="projectID" id="projectID" value="{{ $projectID ?? 0 }}" required>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $("form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            utm_source: {
                required: true
            },
            utm_medium: {
                required: true
            },
            date: {
                required: true,
                date: true
            }
        },
        messages: {
            first_name: {
                required: "First name is required",
                minlength: "First name must be at least 2 characters long"
            },
            email: {
                required: "Email is required",
                email: "Please enter a valid email address"
            },
            phone_number: {
                required: "Phone number is required",
                digits: "Phone number should contain only digits",
                minlength: "Phone number must be at least 10 digits",
                maxlength: "Phone number cannot exceed 15 digits"
            },
            utm_source: {
                required: "UTM Source is required"
            },
            utm_medium: {
                required: "UTM Medium is required"
            },
            date: {
                required: "Date is required",
                date: "Please enter a valid date"
            }
        },
        errorPlacement: function(error, element) {
            error.addClass('text-danger');
            error.appendTo(element.parent());
        }
    });
});
</script>
@endpush
