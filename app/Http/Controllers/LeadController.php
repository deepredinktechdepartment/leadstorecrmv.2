<?php
namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;

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



        $clientId = 29; // Example client ID
$leadData = [
'name' => 'John Doe',
'email' => 'john.doe@example.com',
'mobile' => '123-456-7890',
'url' => 'http://example.com',
'remark' => 'Interested in product',
'lead_project_nm' => 'New Project',
'source_type' => 'Online',
'city' => 'New York',
'location' => 'NY',
'budget' => '5000'
];

$response = $this->sendLeadDataToCRM($clientId, $leadData);

dd($response);
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



        $response = $this->sendLeadDataToCRM($clientId, $leadData);


    exit(); // Ensure no further code is executed
    } else {
    // Redirect to error page
    return response()->json(['status' => 'error', 'message' => $responseData['message']]);
    exit(); // Ensure no further code is executed
    }




    }

    function sendLeadDataToCRM($clientId, $leadData)
    {
        // Retrieve CRM settings for the client
        $type = 'external_crm_config';
        $setting = Setting::where('client_id', $clientId)
            ->where('type', $type)
            ->first();

        if (!$setting) {
            return response()->json(['error' => 'CRM settings not found.'], 404);
        }

        $config = json_decode($setting->form_data, true);

        // Check if configuration is active
        if (!isset($config['is_active']) || $config['is_active'] != 1) {
            return response()->json(['error' => 'CRM configuration is inactive.'], 400);
        }

        // Prepare the URL template
        $urlTemplate = $config['schema'] ?? '';

        // Define placeholders and their replacements
        $placeholders = [
            '{{mobile}}' => $leadData['mobile'] ?? '',
            '{{email}}' => $leadData['email'] ?? '',
            '{{name}}' => $leadData['name'] ?? '',
            '{{url}}' => $leadData['url'] ?? '',
            '{{notes}}' => $leadData['remark'] ?? '',
            '{{lead_project_nm}}' => $leadData['lead_project_nm'] ?? '',
            '{{source_type}}' => $leadData['source_type'] ?? '',
            '{{city}}' => $leadData['city'] ?? '',
            '{{location}}' => $leadData['location'] ?? '',
            '{{utm_source}}' => $leadData['source_type'] ?? '',  // Assuming this maps to 'source_type'
            '{{amob}}' => $leadData['mobile'] ?? ''  // Assuming this maps to 'mobile'
        ];

        // Replace placeholders in the URL template with lead data
        $leadData = str_replace(array_keys($placeholders), array_values($placeholders), $urlTemplate);



        // Prepare cURL request
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $config['api_url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($leadData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        // Add authorization header based on the authentication method
        switch ($config['auth_method']) {
            case 'Bearer Token':
                if (isset($config['api_token'])) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(
                        curl_getinfo($ch, CURLINFO_HTTPHEADER),
                        ['Authorization: Bearer ' . $config['api_token']]
                    ));
                }
                break;

            case 'API Key':
                if (isset($config['api_key'])) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(
                        curl_getinfo($ch, CURLINFO_HTTPHEADER),
                        ['Authorization: ApiKey ' . $config['api_key']]
                    ));
                }
                break;

            case 'Username & Password':

                if (isset($config['username']) && isset($config['password'])) {
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, $config['username'] . ':' . $config['password']);
                }
                break;

            default:
                return response()->json(['error' => 'Unknown authentication method.'], 400);
        }

        // Execute cURL request
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close cURL resource
        curl_close($ch);

        // Handle response
        if ($httpCode >= 200 && $httpCode < 300) {
            return response()->json(['success' => 'Lead data sent successfully.', 'response' => $response], $httpCode);
        } else {
            return response()->json(['error' => 'Failed to send lead data.', 'response' => $response, 'error' => $error], $httpCode);
        }
    }



}
