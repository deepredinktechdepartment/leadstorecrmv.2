@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Column 1 -->
    <div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <form id="clientForm" action="{{ isset($client) ? route('clients.save', Crypt::encrypt($client->id)) : route('clients.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $client->email ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="industry" class="form-label">Industry:</label>
                            <input type="text" id="industry" name="industry" class="form-control" value="{{ old('industry', $client->industry ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="address1" class="form-label">Address 1:</label>
                            <input type="text" id="address1" name="address1" class="form-control" value="{{ old('address1', $client->address1 ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City:</label>
                            <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $client->city ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <input type="text" id="country" name="country" class="form-control" value="{{ old('country', $client->country ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="pan" class="form-label">PAN:</label>
                            <input type="text" id="pan" name="pan" class="form-control" value="{{ old('pan', $client->pan ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook URL:</label>
                            <input type="url" id="facebook" name="facebook" class="form-control" value="{{ old('facebook', $client->facebook ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Project Logo:</label>
                            <input type="file" id="logo" name="logo" class="form-control">
                            @if(isset($client) && $client->logo)
                                <small class="form-text text-muted">Current logo: {{ $client->logo }}</small>
                            @endif
                        </div>
                    </div>
                    <!-- Column 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address2" class="form-label">Address 2:</label>
                            <input type="text" id="address2" name="address2" class="form-control" value="{{ old('address2', $client->address2 ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State:</label>
                            <input type="text" id="state" name="state" class="form-control" value="{{ old('state', $client->state ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="zip" class="form-label">Zip Code:</label>
                            <input type="text" id="zip" name="zip" class="form-control" value="{{ old('zip', $client->zip ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="domain" class="form-label">Domain URL:</label>
                            <input type="url" id="domain" name="domain" class="form-control" value="{{ old('domain', $client->domain ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tan" class="form-label">TAN:</label>
                            <input type="text" id="tan" name="tan" class="form-control" value="{{ old('tan', $client->tan ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter URL:</label>
                            <input type="url" id="twitter" name="twitter" class="form-control" value="{{ old('twitter', $client->twitter ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn URL:</label>
                            <input type="url" id="linkedin" name="linkedin" class="form-control" value="{{ old('linkedin', $client->linkedin ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram URL:</label>
                            <input type="url" id="instagram" name="instagram" class="form-control" value="{{ old('instagram', $client->instagram ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="api_url" class="form-label">External API URL:</label>
                            <input type="url" id="api_url" name="api_url" class="form-control" value="{{ old('api_url', $client->api_url ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes:</label>
                            <textarea id="notes" name="notes" class="form-control">{{ old('notes', $client->notes ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Update Client' : 'Create Client' }}</button>
            </form>
        </div>
    </div>
    </div>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        document).ready(function() {
    $.validator.addMethod("fileSize", function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, "File size must be less than {0} bytes.");

    $.validator.addMethod("fileType", function(value, element, param) {
        return this.optional(element) || element.files[0].type.match(param);
    }, "Invalid file type.");

    $.validator.addMethod("fileHeight", function(value, element, param) {
        var file = element.files[0];
        if (file) {
            var img = new Image();
            img.src = URL.createObjectURL(file);
            return new Promise((resolve, reject) => {
                img.onload = function() {
                    resolve(img.height < param);
                };
                img.onerror = reject;
            });
        }
        return true;
    }, "Invalid image height.");


        $('#clientForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    maxlength: 20
                },
                industry: {
                    maxlength: 255
                },
                address1: {
                    maxlength: 255
                },
                address2: {
                    maxlength: 255
                },
                city: {
                    maxlength: 255
                },
                state: {
                    maxlength: 255
                },
                country: {
                    maxlength: 255
                },
                zip: {
                    maxlength: 20
                },
                domain: {
                    url: true
                },
                pan: {
                    maxlength: 10
                },
                tan: {
                    maxlength: 10
                },
                facebook: {
                    url: true
                },
                twitter: {
                    url: true
                },
                linkedin: {
                    url: true
                },
                instagram: {
                    url: true
                },
                api_url: {
                    url: true
                },
                notes: {
                    maxlength: 1000
                },
                logo: {
                extension: "jpeg|png",
                fileSize: 200 * 1024, // 200 KB
                fileHeight: 55
            }
            },
            messages: {
                name: {
                    required: "Please enter the client's name.",
                    minlength: "Name must be at least 2 characters long."
                },
                email: {
                    required: "Please enter a valid email address.",
                    email: "Please enter a valid email address."
                },
                domain: {
                    url: "Please enter a valid URL."
                },
                api_url: {
                    url: "Please enter a valid URL."
                },
                facebook: {
                    url: "Please enter a valid Facebook URL."
                },
                twitter: {
                    url: "Please enter a valid Twitter URL."
                },
                linkedin: {
                    url: "Please enter a valid LinkedIn URL."
                },
                instagram: {
                    url: "Please enter a valid Instagram URL."
                },
                logo: {
                fileSize: "The logo must be less than 200KB.",
                extension: "Only PNG and JPEG files are allowed.",
                fileHeight: "The height of the logo must be less than 55 pixels."
            }
            }
        });
    });
</script>
@endpush
