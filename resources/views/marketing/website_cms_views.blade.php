@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')



<div class="row">
<div class="col-md-12">

    <table class="table">

        <tbody>
            @foreach(json_decode($socialMediaData->digital_assets, true) as $platform => $data)

            <tr>
                <td colspan="3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Platform: {{ $platform }}</h4>
                            <p class="card-text">Handle: {{ $data['handle']??'' }}</p>
                            <p class="card-text">Password: {{ str_repeat('*', strlen($data['password']??'')) }} </p>
                            <p class="card-text">Login Page: <a target="_new" href="{{ $data['loginpage'] }}"><u>{{ $data['loginpage'] }}</u></a></p>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
</div>








@endsection
@push('scripts')

@endpush