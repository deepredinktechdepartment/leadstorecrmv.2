@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')



<div class="row">
@if (!empty($uploads_files['brand_assets_logos']))
    @foreach ($uploads_files['brand_assets_logos'] as $logo)
        @php
            $extension = pathinfo($logo, PATHINFO_EXTENSION); // Get the file extension
        @endphp

        @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif','avif']))
            <div class="col-md-2">
                <div class="card mb-4 h-100">
                    <img src="{{ asset('storage/app/' . $logo) }}" class="card-img-top" alt="Logo" style="width: 100px; height: 100px;">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        @elseif (in_array($extension, ['pdf']))
            <div class="col-md-2">
                <div class="card mb-4 h-100">
                    <div class="centered-icon mt-4">
                    <i class="fa-sharp fa-regular fa-file-pdf fa-2xl" style="color: #df4411;"></i>
                    <div class="card-body mb-4 text-align-middle">
                        <a href="{{ asset('storage/app/' . $logo) }}" download="file.pdf"><u>Download PDF</u></a>
                    </div>
                </div>
                </div>
            </div>
            @elseif (in_array($extension, ['ttf','otf']))
            <div class="col-md-2">
                <div class="card mb-4 h-100">
                    <div class="centered-icon mt-4">
                        <i class="fa-solid fa-font fa-beat fa-2xl" style="color: #da4d10;"></i>
                    <div class="card-body mb-4 text-align-middle">
                        <a href="{{ asset('storage/app/' . $logo) }}" >Download Fonts</a>
                    </div>
                </div>
                </div>
            </div>
        @endif
    @endforeach

    @endif

</div>








@endsection
@push('scripts')

@endpush