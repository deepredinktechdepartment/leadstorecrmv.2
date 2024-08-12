@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Start col -->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    @if(isset($theme_options_data->id))
                    <div class="d-flex justify-content-end align-items-center gap-3 mb-2">
                        <a href="{{ url('theme_options/edit/'.Crypt::encrypt($theme_options_data->id) ?? 0) }}" class="edit mr-2" title="Edit">
                            {!! Config::get('constants.EditIcon') !!}
                        </a>
                    </div>

                    <!-- Header Logo -->
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4">
                            <h4>Header Logo</h4>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                @if(isset($theme_options_data->header_logo) && file_exists(storage_path('app/uploads/' . basename($theme_options_data->header_logo))))
                                    <img src="{{ URL::to($theme_options_data->header_logo) }}" width="100" />
                                @else
                                    <p>No header logo available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4">
                            <h4>Favicon</h4>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                @if(isset($theme_options_data->favicon) && file_exists(storage_path('app/uploads/' . basename($theme_options_data->favicon))))
                                    <img src="{{ URL::to($theme_options_data->favicon) }}" />
                                @else
                                    <p>No favicon available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer Logo -->
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4">
                            <h4>Footer Logo</h4>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                @if(isset($theme_options_data->footer_logo) && file_exists(storage_path('app/uploads/' . basename($theme_options_data->footer_logo))))
                                    <img src="{{ URL::to($theme_options_data->footer_logo) }}" width="50" />
                                @else
                                    <p>No footer logo available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4">
                            <h4>Copyright</h4>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                @if(isset($theme_options_data->copyright) && !empty($theme_options_data->copyright))
                                    <p>{{ $theme_options_data->copyright }}</p>
                                @else
                                    <p>No copyright information available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
</div>
@endsection
