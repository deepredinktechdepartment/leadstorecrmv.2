@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Start col -->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <form id="themeOptionsForm" method="POST" action="{{ url('theme_options/update/'.Crypt::encrypt($theme_options_data->id)) }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($theme_options_data->id))
                        <input type="hidden" name="id" value="{{ Crypt::encrypt($theme_options_data->id) }}">
                        @endif

                        <!-- Header Logo -->
                        <div class="form-group">
                            <label>Header Logo<span class="imp_str">*</span></label>
                            <input type="file" name="header_logo" class="form-control file-input"
                                @if(!isset($theme_options_data->header_logo)) required @endif />
                        </div>

                        @if(isset($theme_options_data->header_logo) && file_exists(storage_path('app/uploads/' . basename($theme_options_data->header_logo))))
                        <img src="{{ URL::to($theme_options_data->header_logo) }}" width="100"  />
                        @endif

                        <!-- Favicon -->
                        <div class="form-group mt-2">
                            <label>Favicon</label>
                            <input type="file" name="favicon" class="form-control file-input"
                                @if(!isset($theme_options_data->favicon)) required @endif />
                        </div>

                        @if(isset($theme_options_data->favicon) && file_exists(storage_path('app/uploads/' . basename($theme_options_data->favicon))))
                        <img src="{{ URL::to($theme_options_data->favicon) }}"  />
                        @endif

                        <!-- Footer Icon -->
                        <div class="form-group mt-2">
                            <label>Footer Icon</label>
                            <input type="file" name="footer_logo" class="form-control file-input"
                                @if(!isset($theme_options_data->footer_logo)) required @endif />
                        </div>

                        @if(isset($theme_options_data->footer_logo) && file_exists(storage_path('app/uploads/' . basename($theme_options_data->footer_logo))))
                        <img src="{{ URL::to($theme_options_data->footer_logo) }}" width="50"  />
                        @endif

                        <!-- Copyright Description -->
                        <div class="form-group">
                            <label>Copyright Description</label>
                            <textarea name="copyright" id="title" class="form-control" rows="3">{{ isset($theme_options_data->id) ? $theme_options_data->copyright : old('copyright') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
</div>

<!-- jQuery Validation Script -->
<script>
    $(document).ready(function () {
        // Initialize jQuery Validation
        $("#themeOptionsForm").validate({
            rules: {
                header_logo: {
                    required: function() {
                        return !{{ isset($theme_options_data->header_logo) ? 'true' : 'false' }};
                    },
                    extension: "jpg|jpeg|png|gif"
                },
                favicon: {
                    required: function() {
                        return !{{ isset($theme_options_data->favicon) ? 'true' : 'false' }};
                    },
                    extension: "ico|png|jpg|jpeg"
                },
                footer_logo: {
                    required: function() {
                        return !{{ isset($theme_options_data->footer_logo) ? 'true' : 'false' }};
                    },
                    extension: "ico|png|jpg|jpeg"
                },
                copyright: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                header_logo: {
                    required: "Please upload a header logo",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
                },
                favicon: {
                    required: "Please upload a favicon",
                    extension: "Please upload a valid file (ico, png, jpg, jpeg)"
                },
                footer_logo: {
                    required: "Please upload a footer icon",
                    extension: "Please upload a valid file (ico, png, jpg, jpeg)"
                },
                copyright: {
                    required: "Please enter a copyright description",
                    minlength: "Your copyright description must be at least 5 characters long"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
