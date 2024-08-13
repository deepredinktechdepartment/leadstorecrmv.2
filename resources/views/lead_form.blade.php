<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Lead Form</h1>
        <form id="leadForm" action="{{ route('lead.submit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="project_id" class="form-label">Project ID</label>
                    <input type="text" class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id" value="{{ old('project_id', '29') }}">
                    @error('project_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName" value="{{ old('firstName', 'venka') }}">
                    @error('firstName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" value="{{ old('lastName', '') }}">
                    @error('lastName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', 'test@mail.com') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', '9052691535') }}">
                    @error('phoneNumber')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="countryCode" class="form-label">Country Code</label>
                    <input type="text" class="form-control @error('countryCode') is-invalid @enderror" id="countryCode" name="countryCode" value="{{ old('countryCode', '1') }}">
                    @error('countryCode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="utm_source" class="form-label">UTM Source</label>
                    <input type="text" class="form-control @error('utm_source') is-invalid @enderror" id="utm_source" name="utm_source" value="{{ old('utm_source', 'facebook') }}">
                    @error('utm_source')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="utm_medium" class="form-label">UTM Medium</label>
                    <input type="text" class="form-control @error('utm_medium') is-invalid @enderror" id="utm_medium" name="utm_medium" value="{{ old('utm_medium', 'GDN') }}">
                    @error('utm_medium')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="utm_campaign" class="form-label">UTM Campaign</label>
                    <input type="text" class="form-control @error('utm_campaign') is-invalid @enderror" id="utm_campaign" name="utm_campaign" value="{{ old('utm_campaign', 'holiday_promo') }}">
                    @error('utm_campaign')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="utm_term" class="form-label">UTM Term</label>
                    <input type="text" class="form-control @error('utm_term') is-invalid @enderror" id="utm_term" name="utm_term" value="{{ old('utm_term', 'gifts') }}">
                    @error('utm_term')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="utm_content" class="form-label">UTM Content</label>
                    <input type="text" class="form-control @error('utm_content') is-invalid @enderror" id="utm_content" name="utm_content" value="{{ old('utm_content', 'free_shipping') }}">
                    @error('utm_content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="sourceURL" class="form-label">Source URL</label>
                    <input type="text" class="form-control @error('sourceURL') is-invalid @enderror" id="sourceURL" name="sourceURL" value="{{ old('sourceURL', 'https://www.example.com') }}">
                    @error('sourceURL')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message">{{ old('message', 'Please call me back.') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', 'Los Angeles') }}">
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="UDF" id="udfField">
                <div class="col-md-12 mb-3">
                    <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <!-- Loading Message -->
        <div id="loading-message" class="alert alert-info" style="display:none;">
            <p>Loading... <i class="fa fa-spinner fa-spin"></i></p>
        </div>

        <!-- Success and Error Message -->
        <div id="response-message" style="display:none;">
            <p id="response-text"></p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#leadForm').on('submit', function() {
                // Prepare UDF data
                var udfData = [
                    {
                        "fieldName": "Budget",
                        "fieldValue": "2Lack"
                    },
                    {
                        "fieldName": "OTP Verified",
                        "fieldValue": "Yes"
                    }
                ];

                // Set UDF data in hidden field
                $('#udfField').val(JSON.stringify(udfData));

                // Show the loading message
                $('#loading-message').show();
                $('#submitButton').text('Submitting...').attr('disabled', true);
            });
        });
    </script>
</body>
</html>
