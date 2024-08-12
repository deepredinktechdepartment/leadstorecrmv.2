@extends('layouts.app')
@section('content')

<div class="row ">
 <div class="col-md-12">

{{-- Leads counts --}}

@if($projectID && !$error)
@include("marketing.crm.leads_countlable")
@endif

{{-- Filters over leads data --}}
@if($projectID && !$error)
@include("marketing.crm.filteronleads")
@endif
{{-- Leads Views --}}


@if($projectID)

<div class="row card">
    <div class="col-md-12">


       @if(!$error)


       <table class="table table-striped table-hover dataTable no-footer" id="data-table" role="grid" aria-describedby="sorting_table_info">

        <thead>
            <tr>
                <th>S.No.</th>
                <th>Date</th>
                <th>Lead Customer</th>
                <th>Source&Medium</th>
                <!--<th>Revenue</th>-->
                <th>Status</th>
                <th>Actions</th>
                <!-- Add other column headers as needed -->
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    @else

        @if(!empty($error) && isset($error))
        {{-- <h4 class="alert alert-danger">{{ $error['error']??'' }}</h4> --}}

        <p>Configuration is not setup.<p>
        @endif
    @endif





</div>
</div>

@endif




{{-- End --}}

</div>
</div>

<div id="editRemarkModal" class="modal fade" tabindex="-1" aria-labelledby="editRemarkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRemarkModalLabel">Edit Remark</h5>
                <!-- Close button with Bootstrap 5 styling -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Wrap your code in a <form> element -->
                <form id="editRemarkForm">
                    <div class="form-group">
                        <label for="newRemark">New Remark{!!Config::get('constants.astric_syb')!!}</label>
                        <!-- Replace the input with a textarea -->
                        <textarea class="form-control" id="newRemark" name="newRemark" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status{!!Config::get('constants.astric_syb')!!}</label>
                        <select style="padding: 0px 0px; margin: 0px; font-size: 13px;" name="status" id="status" class="form-control">
                            <option value="New Lead" selected>New Lead</option>
                            <option value="Lead Valid">Lead Valid</option>
                            <option value="Call Back">Call Back</option>
                            <option value="Converted">Converted</option>
                            <option value="Discard">Discard</option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="LeadID" name="LeadID">
                    <button type="submit" class="btn btn-primary saveRemark" id="loading-message">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Optionally, you can include a secondary button here -->
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>






@endsection
@push('scripts')


<script>

$(document).ready(function() {
    var jsonData = @json($Jdata);
    var yourDataArray =jsonData;
    // Initialize DataTables

    var table = $('#data-table').DataTable({
        lengthMenu: [[50, 100, 150, -1], [50, 100, 150, "All"]],
        processing: false,
        data: yourDataArray, // Replace with your JSON data array
        columns: [
{
data: null,
render: function (data, type, full, meta) {
// Return the serial number (index + 1)
return meta.row + 1;
},
title: "No", // Add title for the serial number column
orderable: false, // Disable sorting on this column
searchable: false // Disable searching on this column
},

{
    data: null,
    render: function (data, type, full, meta) {
        if (type === 'display' || type === 'filter') {
            var datetime = data.lead_last_update_date;
            var dateTimeParts = datetime.split(' ');
            if (dateTimeParts.length === 2) {
                var dateParts = dateTimeParts[0].split('-');
                var timePart = dateTimeParts[1];
                if (dateParts.length === 3) {

                    var url = '{{ route("Single.Lead.Data") }}';
                    var link = '<a target="_new" href="' + url + '/?leadID='+data.id+'&projectID={{ $projectID }}"><u>' + dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0] +'</u></a>';
                    return link;
                }
            }
        }
        return data;
    }
}

,


{
    data: null,
    render: function(data, type, full, meta) {
        if (type === 'display') {
            var content = '<p style="line-height:18px;">';
            if (data.firstname) {
                content += '<strong>' + data.firstname + '</strong>';
            }
            if (data.email) {
                content += (content ? '<br>' : '') + '<small>' + data.email + '</small>';
            }
            if (data.phone) {
                content += (content ? '<br>' : '') + '<small>' + data.phone + '</small>';
            }
            content += '</p>';
            return content;
        } else {
            // Return data as is for other types (filter, sort, etc.)
            return data;
        }
    }
}

            ,
            {
                data: null,
                        render: function(data, type, full, meta) {
                            var source = data.utm_source; // Assuming 'Source' is in the second column (index 1)

                            // Define icons based on the source
                            var iconsHtml = '';
                            if (source === 'Google') {
                                iconsHtml = '<i class="fa-brands fa-square-google-plus fa-lg" style="color: #db4437;"></i>';
                            } else if (source === 'Facebook') {
                                iconsHtml = '<i class="fa-brands fa-square-facebook fa-lg" style="color: #4267b2;"></i>';
                            } else if (source === 'Twitter') {
                                iconsHtml = '<i class="fa-brands fa-square-twitter fa-lg" style="color: #1da1f2;"></i>';
                            }
                            else if (source === 'LinkedIn') {
                                iconsHtml = '<i class="fa-brands fa-linkedin fa-lg" style="color: #0072b1;"></i>';
                            }
                            else if (source === 'Direct') {
                                iconsHtml = '<i class="fa-brands fa-wpforms fa-flip-horizontal fa-lg" style="color: #144aa9;"></i>';
                            }
                            else{
                                iconsHtml = '<i class="fa-brands fa-wpforms fa-flip-horizontal fa-lg" style="color: #144aa9;"></i>';
                            }
                            // You can add more conditions for other social media sources

                            return iconsHtml+"  "+data.utm_medium;
                        }
                    }
                    ,

// {
// data: null,
// render: function(data, type, full, meta) {
//     return "0";
// }
// },

                            {
                                data: null, // Target the 'Status' column (index 1)
                         render: function(data, type, row) {
                            var status =data.status; // Assuming 'Status' is in the second column (index 1)

                            // Define labels and classes based on the status
                            var label = '';
                            var labelClass = '';

                            if (status == 'New Lead') {
                                label = 'New Lead';
                                labelClass = 'bg-success'; // Define a CSS class for the status
                            } else if (status == 'Call Back') {
                                label = 'Call Back';
                                labelClass = 'bg-danger';
                            }
                            else if (status == 'Discard') {
                                label = 'Discard';
                                labelClass = 'bg-danger';
                            }

                            // Create the HTML for the status label
                            var statusHtml = '<span class="badge ' + labelClass + '">' + label + '</span>';

                            return statusHtml;
                        }
                    }
                          ,

                          {
        data: null,
        render: function (data, type, row) {
            statusHtml="";
                                statusHtml+= '<a href="#'+ data.id+'" class="delete-button" data-id="' + data.id + '"><i class="fa-solid fa-trash-can-arrow-up fa-lg" style="color: #cd1818;"></i></a>';
                                statusHtml+= '&nbsp;&nbsp;';
                                statusHtml+= '<a href="#'+ data.id+'" class="edit-button" data-id="' + data.id + '"><i class="fa-solid fa-comments fa-lg" style="color: #1160e8;"></i></a>';


            return statusHtml;
        }
    },


            // Add other column configurations as needed
        ],
    });


$('#data-table').on('click', '.edit-button', function () {
    var id = $(this).data('id');
    var existingRemark =""; /* Get the existing remark from your data source */;
    $('#newRemark').val(existingRemark);
    $('#LeadID').val(id);
    $('#editRemarkModal').modal('show');
});
// Listen for the form's submit event
$('#editRemarkForm').on('submit', function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Show the loading message
    $('#loading-message').show();

    var newRemark = $('#newRemark').val();
    var id = $('#LeadID').val();
    var lead_status = $('#status').val();

    // Make an API request to update the remark
    $.ajax({
        url: "{{ route('api.UpdateCRMRecord') }}",
        type: 'GET',
        dataType: "json",
        data: {
            remark: newRemark,
            record_id: id,
            lead_status: lead_status,
            projectID: '{{ $projectID }}'
        },
        success: function (response) {
            // Handle success, update the data source with the new remark
            // Close the modal
            if (response.status == 'success') {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
            $('#editRemarkModal').modal('hide');

            // Remove the selected-row class from any selected rows
            $('#data-table tbody tr.selected-row').removeClass('selected-row');
        },
        error: function (xhr, status, error) {
            // Handle error, display an error message or log the error
            console.error(error);
            toastr.error(error);
        },
        complete: function () {
            // Hide the loading message when the request is complete
            $('#loading-message').hide();
        }
    });
});




// Now, the form will submit when you press Enter, and the same function will be called.

$('#data-table').on('click', 'tr', function () {
    var tr = $(this);

    // Check if the clicked row is already selected
    if (tr.hasClass('selected-row')) {
        // Row is already selected, so remove the selection
        tr.removeClass('selected-row');
    } else {
        // Row is not selected, so select it and remove selection from other rows
        $('#data-table tbody tr').removeClass('selected-row');
        tr.addClass('selected-row');
    }
});

// Modify the delete button click event to handle the selected row
$('#data-table').on('click', '.delete-button', function (event) {
    // Prevent the click event from propagating to the row click event
    event.stopPropagation();

    var id = $(this).data('id');

    // Store the reference to the clicked row
    var tr = $(this).closest('tr');

    // You can confirm the delete action with a confirmation dialog if needed
    if (confirm('Are you sure you want to delete this record?')) {
        // Make an AJAX request to your API to delete the record
        $.ajax({
            url: "{{ route('api.DeleteCRMRecord') }}", // Use the named route
            type: "GET",
            dataType: "json",
            data: {
                record_id: id,
                projectID: '{{ $projectID }}'
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == 'success') {
                    // If the deletion was successful, remove the row from the table
                    toastr.success(response.message);

                    // Explicitly remove the row from the DOM
                    tr.remove();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle error, show an error message, or log the error
                console.error(error);
                toastr.error(error);
            }
        });
    }
});









});

// Function to format the expanded row content
function formatRowData(data) {
    var html = '<div>';
    // Add additional information here based on your data object
    html += '<p>Name: ' + data.firstname + '</p>';
    html += '<p>UTM Source: ' + data.utm_source + '</p>';
    html += '<p>UTM Medium: ' + data.utm_medium + '</p>';
    html += '<p>UTM Campaign: ' + data.utm_campaign + '</p>';
    html += '<p>UTM Term: ' + data.utm_term + '</p>';
    html += '<p>UTM utm_content: ' + data.utm_content + '</p>';
    html += '<p>UDF1: ' + data.udf1 + '</p>';
    html += '<p>UDF2: ' + data.udf2 + '</p>';
    html += '<p>UDF3: ' + data.udf3 + '</p>';
    html += '<p>UDF4: ' + data.udf4 + '</p>';
    html += '<p>UDF5: ' + data.udf5 + '</p>';
    html += '<p>Page: ' + data.ua_query_url + '</p>';
    // Add more fields as needed
    html += '</div>';
    return html;
}



</script>


<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
</script>


@endpush