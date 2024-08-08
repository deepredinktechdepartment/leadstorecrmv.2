@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

<div class="row card">
    <div class="col-md-5 mb-5">

        <form action="{{ route('mkt.brand-assets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <!-- Logo Upload -->
            <div class="form-group">
            <label for="logo_png">Logo PNG (Max 2MB)</label>
            <input class="form-control" type="file" name="logo_png" accept=".png">
            </div>

            <!-- Add similar fields for other logo formats (EPS, TIFF, AI, CDR, PDF) -->

            <!-- Brand Colors -->
            <div class="form-group">
            <label for="primary_colors">Primary Colors (RGB / Hex)</label>
            <input class="form-control" type="text" name="primary_colors[]" placeholder="RGB / Hex">
            </div>
            <!-- Add up to 10 primary color input fields -->

            <div class="form-group">
            <label for="secondary_colors">Secondary Colors (RGB / Hex)</label>
            <input class="form-control" type="text" name="secondary_colors[]" placeholder="RGB / Hex">
            </div>
            <!-- Add up to 10 secondary color input fields -->

            <!-- Brand Fonts -->
            <div class="form-group">
            <label for="brand_fonts_ttf">Brand Fonts TTF</label>
            <input class="form-control" type="file" name="brand_fonts_ttf" accept=".ttf">

            <label for="brand_fonts_otf">Brand Fonts OTF</label>
            <input class="form-control" type="file" name="brand_fonts_otf" accept=".otf">

            <label for="brand_fonts_web">Brand Fonts Web (Adobe Link / Google Link / WOFF Upload)</label>
            <input class="form-control" type="text" name="brand_fonts_web">
            </div>

            <!-- Brand Manual -->
            <div class="form-group">
            <label for="brand_manual_pdf">Brand Manual PDF</label>
            <input class="form-control" type="file" name="brand_manual_pdf" accept=".pdf">
            </div>

            <!-- Mascots -->
            <div class="form-group">
            <label for="mascots">Mascots</label>
            <textarea class="form-control" name="mascots"></textarea>
            </div>

            <!-- Jingle / Tagline -->
            <div class="form-group">
            <label for="jingle_tagline">Jingle / Tagline</label>
            <textarea class="form-control" name="jingle_tagline"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </form>



    </div>
</div>


@endsection
@push('scripts')

@endpush