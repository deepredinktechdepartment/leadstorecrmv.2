@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

<div class="row card">
<div class="col-lg-6">



    <form action="{{ route('brandassets.upload.files',['type_of_upload'=>$type_of_upload]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- PNG File -->
        <div class="form-group">
        <label for="png_file">File1{!! Config::get('constants.astric_syb') !!} <small>({{ $formlable['file1']??'' }})</small></label>
        <input type="file" name="png_file[]"  required class="form-control">
        </div>

        <!-- EPS / TIFF / AI / CDR / PDF File -->
        <div class="form-group">
        <label for="eps_file"> File2 <small>(Artwork)</small> {!! Config::get('constants.optional_input_brackets') !!}: ({{ $formlable['file2']??'' }})</label>
        <input type="file" name="eps_tiff_ai_cdr_pdf_file[]" class="form-control"/>
        </div>
        <button type="submit" class="btn btn-primary btn-sm mt-4">Upload Files</button>
    </form>


</div>
</div>



@endsection
@push('scripts')

@endpush