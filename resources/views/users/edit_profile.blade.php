@extends('layouts.app')
@section('content')
<div class="row">
    <!-- Start col -->
    <div class="col-lg-6">
        <div class="card m-b-30">

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Full Name -->
                                    <div class="mb-0">
                                        <label for="firstname" class="form-label">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{ old('firstname', Auth::user()->fullname ?? '') }}" required />

                                    </div>

                                    <!-- Email -->
                                    <div class="mb-0">
                                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', Auth::user()->username ?? '') }}" required />

                                    </div>

                                    <!-- Mobile -->
                                    <div class="mb-0">
                                        <label for="phone" class="form-label">Mobile<span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', Auth::user()->phone ?? '') }}" required maxlength="10" minlength="10" />

                                    </div>

                                    <!-- Profile Picture -->
                                    <div class="mb-0">
                                        <label for="profile" class="form-label">Profile</label>
                                        <input type="file" name="profile" class="form-control" id="profile" />

                                    </div>

                           <!-- Display Profile Picture -->


                       <!-- Display Profile Picture -->
                       <div class="mb-1 ">

                           @if(Auth::user()->profile_photo && File::exists(storage_path('app/public/' . Auth::user()->profile_photo)))

                               <img src="{{ URL::to(env('APP_STORAGE').''.Auth::user()->profile_photo) }}"
                                    class="img-fluid rounded-circle border border-secondary mt-2"
                                    width="100"
                                    alt="Profile Picture" />
                           @else

                           @endif
                       </div>





                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
</div>
@endsection

@push('scripts')

<script>
$(document).ready(function() {
    $('#profileForm').validate({
        rules: {
            firstname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            profile: {
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            firstname: {
                required: "Please enter your full name"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your mobile number",
                minlength: "Mobile number must be exactly 10 digits",
                maxlength: "Mobile number must be exactly 10 digits"
            },
            profile: {
                extension: "Only image files are allowed (jpg, jpeg, png, gif)"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.mb-1').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
});
</script>
@endpush
