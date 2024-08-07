@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card mb-1">
            <div class="card-body">
                <form id="changePasswordForm" action="{{ route('verifying.password') }}" method="post">
                    @csrf
                    <div class="mb-2 row">
                        <label for="password" class="col-sm-5 col-form-label">New Password <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" id="password" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-sm-5 col-form-label">Confirm New Password <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <div class="col-sm-7 offset-sm-5">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
$(document).ready(function () {
    $('#changePasswordForm').validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Please enter a new password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please confirm your new password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Passwords do not match"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-sm-8').append(error);
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
