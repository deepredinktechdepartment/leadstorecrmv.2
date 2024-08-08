@extends('template_v2')
@section('title', $pageTitle??'')
@section('content')

<style>
    ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 25px;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
</style>

<div class="row">
    <div class="col-md-12">



   @if(!$error)


    

    <div class="row">
        
      <div class="col-md-4 card">
            @if (!empty($leadData['leads'][0]))
                <h2 class="mb-4">Lead Details</h2>
                <table class="">
                    @foreach($leadData['leads'] as $key => $value)
                                     <tr>
                            <th>Fullname</th>
                            <td>{{ $value['firstname']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $value['email']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $value['phone']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>UTM Campaign</th>
                            <td>{{ $value['utm_campaign']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>UTM Medium</th>
                            <td>{{ $value['utm_medium']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>UTM Source</th>
                            <td>{{ $value['utm_source']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>UTM Term</th>
                            <td>{{ $value['utm_term']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>UTM Content</th>
                            <td>{{ $value['utm_content']??'NA' }}</td>
                        </tr>
                      <tr>
                      <th>UTM Status</th>
                            <td>{{ $value['status']??'NA' }}</td>
                        </tr>
                        <tr>
                            <th>Registration Date</th>
                            <td>{{ \Carbon\Carbon::parse($value['registeredon']??'NA')->format('M d Y') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated On</th>
                            <td>{{ \Carbon\Carbon::parse($value['lead_last_update_date']??'NA')->format('M d Y') }} </td>
                        </tr>
              
                        
                    @endforeach
                </table>
            @else
                <p>No lead data available.</p>
            @endif
        </div>
        
     <div class="col-md-2"></div>   
<div class=" col-md-4 card">
    
 @if (!empty($leadData['conversations']))
			<h2 class="mb-4">Conversations</h2>
			<ul class="timeline">
			      @foreach($leadData['conversations'] as $key => $value)
				<li>
					<a href="#" class="float-right">{{ date('M j Y', strtotime($value['addedon'])) }}</a>
					<p>{{ $value['remark'] }}</p>
				</li>
				@endforeach
			
			</ul>
     @else
                <p>No lead data available.</p>
            @endif

</div>

</div>






    @else

        @if(!empty($error) && isset($error))
        <h4 class="alert alert-danger">{{ $error['error']??'' }}</h4>
        @endif
    @endif





{{-- End --}}

</div>
</div>






@endsection
@push('scripts')






@endpush