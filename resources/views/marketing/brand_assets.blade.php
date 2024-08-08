@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

        <div class="row">
            <div class="col-lg-12">
            @include("marketing.brand_assets_upload")
        </div>
        </div>


@endsection
@push('scripts')

@endpush