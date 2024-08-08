@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

<div class="row card">
<div class="col-lg-6">




    <form action="{{ route('store.brand.colors',['type_of_upload'=>$type_of_upload]) }}" method="POST">
        @csrf


        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">

                <label for="primary_colors">Primary Colors (Hex){!! Config::get('constants.astric_syb') !!} <br>
                    <small class="text text-danger">Sample code: Hex: #E6E6FA</small></label>
                <input class="form-control" type="text" name="primary_colors[]" placeholder="Hex">
                </div>
                <!-- Add up to 5 primary color input fields -->

                    <div class="form-group">
                        <label for="primary_colors">Primary Colors (Hex)</label>
                        <input class="form-control" type="text" name="primary_colors[]" placeholder="Hex">
                    </div>

                    <div class="form-group">
                        <label for="primary_colors">Primary Colors (Hex)</label>
                        <input class="form-control" type="text" name="primary_colors[]" placeholder="Hex">
                    </div>

                    <div class="form-group">
                        <label for="primary_colors">Primary Colors (Hex)</label>
                        <input class="form-control" type="text" name="primary_colors[]" placeholder="Hex">
                    </div>
                    <div class="form-group">
                        <label for="primary_colors">Primary Colors (Hex)</label>
                        <input class="form-control" type="text" name="primary_colors[]" placeholder="Hex">
                    </div>

            </div>


            <div class="col-lg-6">
                <!-- Add up to 5 secondary color input fields -->

                <div class="form-group">
                <label for="secondary_colors">Secondary Colors (Hex){!! Config::get('constants.astric_syb') !!}<br>

                    <small class="text text-danger">Sample code: Hex: #E6E6FA</small>
                </label>
                <input class="form-control" type="text" name="secondary_colors[]" placeholder="Hex">
                </div>
                <div class="form-group">
                <label for="secondary_colors">Secondary Colors (Hex)</label>
                <input class="form-control" type="text" name="secondary_colors[]" placeholder="Hex">
                </div>
                <div class="form-group">
                <label for="secondary_colors">Secondary Colors (Hex)</label>
                <input class="form-control" type="text" name="secondary_colors[]" placeholder="Hex">
                </div>
               <div class="form-group">
                <label for="secondary_colors">Secondary Colors (Hex)</label>
                <input class="form-control" type="text" name="secondary_colors[]" placeholder="Hex">
                 </div>
                <div class="form-group">
                <label for="secondary_colors">Secondary Colors (Hex)</label>
                <input class="form-control" type="text" name="secondary_colors[]" placeholder="Hex">
                </div>
            </div>

        </div>




        <button type="submit" class="btn btn-primary btn-sm mt-4">Save</button>
    </form>


</div>
</div>



@endsection
@push('scripts')

@endpush