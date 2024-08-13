<?php
namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function export(Request $request)
    {
        // Validate the request if necessary
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'utm_source' => 'nullable|string',
            'utm_medium' => 'nullable|string',
            'utm_campaign' => 'nullable|string',
        ]);

        // Pass the request parameters to the export class
        return Excel::download(new LeadsExport($request->all()), 'leads.xlsx');
    }

     // Method to show the form
     public function showForm()
     {
         return view('lead_form'); // This should match the Blade template file name
     }

      // Method to handle form submission
    public function submit(Request $request)
    {
        // Validate the request




        // Define the parameters as an associative array
        $params = [
            'project_id' => '29',
            'firstName' => $request->firstName,
            'lastName' => '',
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'countryCode' => '1',
            'utm_source' => 'facebook',
            'utm_medium' => 'GDN',
            'utm_campaign' => 'holiday_promo',
            'utm_term' => 'gifts',
            'utm_content' => 'free_shipping',
            'sourceURL' => 'https://www.example.com',
            'message' => 'Please call me back.',
            'city' => 'Los Angeles',
            'UDF' => [
                [
                    'fieldName' => 'Budget',
                    'fieldValue' => '2Lack',
                ],
                [
                    'fieldName' => 'OTP Verified',
                    'fieldValue' => 'Yes',
                ],
            ],
        ];

        // Convert parameters to JSON
        $jsonParams = json_encode($params);

        // Initialize cURL
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://alpha.leadstore.in/crmv.2/api/leads/handle-external-post',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonParams,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-API-KEY: f4d08060-a84c-4447-821f-d8749b4267be',
            ],
        ]);

        // Execute cURL request and get response
        $response = curl_exec($curl);

        // Close cURL resource
        curl_close($curl);

        // Output response



        // Decode the JSON response
$responseData = json_decode($response, true);


    // Check if the response was successful
    if ($responseData['status'] === 'success' && $responseData['success'] === true) {
    // Redirect to thank you page
    return response()->json(['status' => 'success', 'message' => $responseData['message']]);
    exit(); // Ensure no further code is executed
    } else {
    // Redirect to error page
    return response()->json(['status' => 'error', 'message' => $responseData['message']]);
    exit(); // Ensure no further code is executed
    }




    }
}
