<?php
namespace App\Http\Controllers;
use App\Exports\LeadsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use App\Models\Client as Project; // Alias `Client` as `Project`
use Illuminate\Support\Facades\Crypt;
class LeadController extends Controller
{

    public function export(Request $request)
{
    // Validate the request if necessary
    $validated = $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'utm_source' => 'nullable|string',
        'utm_medium' => 'nullable|string',
        'utm_campaign' => 'nullable|string',
        'projectID' => 'nullable|string',
    ]);

    // Handle project decryption with error handling
    try {
        $projectID = Crypt::decrypt($request->projectID);
        $project = Project::find($projectID);

        if (!$project) {
            return back()->withErrors(['projectID' => 'Project not found.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['projectID' => 'Invalid Project ID.']);
    }

    // Construct the filename with the project name and date range
    $clientName = $project->client_name ?? 'project';
    $startDate = $validated['start_date'] ?? '';
    $endDate = $validated['end_date'] ?? '';

    // Format the date for the filename if they exist
    $startDateFormatted = $startDate ? \Carbon\Carbon::parse($startDate)->format('Y-m-d') : '';
    $endDateFormatted = $endDate ? \Carbon\Carbon::parse($endDate)->format('Y-m-d') : '';

    // Create the filename
    $filename = $clientName . '_leads';
    $filename .= $startDateFormatted ? '_from_' . $startDateFormatted : '';
    $filename .= $endDateFormatted ? '_to_' . $endDateFormatted : '';
    $filename .= '.xlsx';

    // Pass the request parameters to the export class
    return Excel::download(new LeadsExport($request->all()), $filename);
}


    // Method to show the form
    public function showForm()
    {
        return view('lead_form'); // This should match the Blade template file name
    }

    public function submit(Request $request)
    {
        // Validate the request
        $request->validate([
            'firstName' => 'required|string',
            'email' => 'required|email',
            'phoneNumber' => 'required|string',
            'countryCode' => 'required|string',
            'utm_source' => 'nullable|string',
            'utm_medium' => 'nullable|string',
            'utm_campaign' => 'nullable|string',
            'utm_term' => 'nullable|string',
            'utm_content' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        $clientId = 70; // Example client ID

        $leadData = [
            'firstName' => $request->firstName ?? '',
            'lastName' => '',
            'email' => $request->email ?? '',
            'phoneNumber' => $request->phoneNumber ?? '',
            'countryCode' => $request->countryCode ?? '',
            'utm_source' => $request->utm_source ?? '',
            'utm_medium' => $request->utm_medium ?? '',
            'utm_campaign' => $request->utm_campaign ?? '',
            'utm_term' => $request->utm_term ?? '',
            'utm_content' => $request->utm_content ?? '',
            'sourceURL' => $request->sourceURL ?? '',
            'message' => $request->message ?? '',
            'city' => $request->city ?? '',
            'project_id' => $clientId ?? 0,
            'UDF' => [
                ['fieldName' => 'Budget', 'fieldValue' => '2Lack'],
                ['fieldName' => 'OTP Verified', 'fieldValue' => 'Yes'],
            ],
        ];

        // First, send lead data to LeadStoreCRM
        $leadStoreCrmResponse = $this->LeadStoreCRM($clientId, $leadData);

        // Decode the JSON response from LeadStoreCRM
        $leadStoreCrmResponseData = json_decode($leadStoreCrmResponse, true);

        // Log response from LeadStoreCRM
        Log::channel('crm')->info('LeadStoreCRM response', [
            'clientId' => $clientId,
            'response' => $leadStoreCrmResponse,
        ]);

        // Initialize the external CRM response variable
        $externalCrmRes = null;

        // Check if LeadStoreCRM response was successful
        if ($leadStoreCrmResponseData['status'] === 'success' && $leadStoreCrmResponseData['success'] === true) {
            // Send lead data to the external CRM if active
            $externalCrmRes = $this->pushleadexternalCRM($clientId, $leadData);

            // Decode the JSON response from the external CRM
            $externalCrmResData = json_decode($externalCrmRes, true);

            // Log response to custom CRM log file with project name and client ID
            Log::channel('crm')->info('Lead data sent to external CRM', [
                'clientId' => $clientId,
                'leadData' => $leadData,
                'response' => $externalCrmRes,
            ]);

            // Return combined response
            return response()->json([
                'status' => 'success',
                'message' => 'Lead data sent successfully to both LeadStoreCRM and the external CRM.',
                'leadStoreCrmResponse' => $leadStoreCrmResponseData,
                'externalCrmRes' =>  $externalCrmRes ?? 'External CRM not configured or inactive.',
            ]);
        } else {
            // Return error response if LeadStoreCRM failed
            return response()->json([
                'status' => 'error',
                'message' => $leadStoreCrmResponseData['message'],
                'leadStoreCrmResponse' => $leadStoreCrmResponseData,
                'externalCrmRes' => 'External CRM not triggered due to LeadStoreCRM failure.',
            ]);
        }
    }

    // Method to send lead data to LeadStoreCRM
    private function LeadStoreCRM($clientId, $leadData)
    {
        // Example LeadStoreCRM URL and API key
        $externalApiUrl = env('APP_URL').'api/leads/handle-external-post';
        //$externalApiUrl = 'https://alpha.leadstore.in/crmv.2/api/leads/handle-external-post';
        $apiKey = '17bdc30f-298c-4726-9da3-40caa33a9dae';

        // Convert parameters to JSON
        $jsonParams = json_encode($leadData);

        // Initialize cURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $externalApiUrl,
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
                'X-API-KEY: ' . $apiKey,
            ],
        ]);

        // Execute cURL request and get response
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            // Log cURL errors
            Log::channel('crm')->error('cURL error', [
                'clientId' => $clientId,
                'error' => curl_error($curl),
            ]);
        }

        // Close cURL resource
        curl_close($curl);

        return $response;
    }

    // Method to send lead data to the external CRM
    private function pushleadexternalCRM($clientId, $leadData)
    {
        // Retrieve CRM settings for the client
        $type = 'external_crm_config';
        $setting = Setting::where('client_id', $clientId)
            ->where('type', $type)
            ->first();


        if (!$setting) {
            $errorResponse = json_encode(['error' => 'CRM settings not found.']);
            Log::channel('crm')->error('CRM settings not found', [
                'clientId' => $clientId,
                'error' => 'CRM settings not found',
            ]);
            return $errorResponse;
        }

        $config = json_decode($setting->form_data, true);


        // Check if configuration is active
        if (!isset($config['is_active']) || $config['is_active'] != 1) {

            $errorResponse = json_encode(['error' => 'CRM configuration is inactive.']);
            Log::channel('crm')->error('CRM configuration is inactive', [
                'clientId' => $clientId,
                'config' => $config,
            ]);
            return $errorResponse;
        }

        // Prepare the URL template
        $urlTemplate = $config['schema'] ?? '';

        // Define placeholders and their replacements
        $placeholders = [
            '{{name}}' => $leadData['firstName'] ?? '',
            '{{property}}' => $leadData['property'] ?? '',
            '{{mobile}}' => $leadData['phoneNumber'] ?? '',
            '{{isOtpVerified}}' => $leadData['isOtpVerified'] ?? '',
            '{{email}}' => $leadData['email'] ?? '',
            '{{sourceurl}}' => $leadData['sourceURL'] ?? '',
            '{{notes}}' => $leadData['message'] ?? '',
            '{{lead_project_nm}}' => $leadData['lead_project_nm'] ?? '',
            '{{source_type}}' => $leadData['utm_source'] ?? '',
            '{{city}}' => $leadData['city'] ?? '',
            '{{location}}' => $leadData['location'] ?? '',
            '{{utm_source}}' => $leadData['utm_source'] ?? '',
            '{{utm_medium}}' => $leadData['utm_medium'] ?? '',
            '{{utm_campaign}}' => $leadData['utm_campaign'] ?? '',
            '{{utm_term}}' => $leadData['utm_term'] ?? '',
            '{{utm_content}}' => $leadData['utm_content'] ?? '',
            '{{amob}}' => $leadData['phoneNumber'] ?? ''
        ];

        // Add username and password placeholders if the authentication method is 'Username & Password'
        if ($config['auth_method'] === 'Username & Password' && !empty($config['password'])) {
            $placeholders['{{username}}'] = $config['username'] ?? '';
            $placeholders['{{password}}'] = $config['password'] ?? '';
        }
        // Add username and password placeholders if the authentication method is 'Username & Password'
        if ($config['auth_method'] === 'API Key' && !empty($config['api_key'])) {
            $placeholders['{{api_key}}'] = $config['api_key'] ?? '';

        }



        // Replace placeholders in the URL template
        if (!is_array($urlTemplate)) {
            Log::channel('crm')->error('URL template is not an array, expected an array of strings.', [
                'clientId' => $clientId,
                'urlTemplate' => $urlTemplate,
            ]);
            throw new \UnexpectedValueException('The URL template must be an array of strings.');
        }

        // Iterate over the array and replace placeholders
        $replacedTemplate = [];
        foreach ($urlTemplate as $key => $value) {
            if (is_string($value)) {
                $replacedTemplate[$key] = strtr($value, $placeholders);
            } else {
                $replacedTemplate[$key] = $value;
            }
        }

        // If api_key exists, add it to the replacedTemplate


        // Determine request method
        $requestMethod = strtoupper($config['request_method'] ?? 'GET');

        // Initialize cURL
        $curl = curl_init();

        if ($requestMethod === 'POST') {

            $headers = [
                'Content-Type: application/json',
            ];


            // Add username and password placeholders if the authentication method is 'Username & Password'
            if ($config['auth_method'] === 'API Header' && !empty($config['x_api_key'])) {
            // Check if 'x-api-key' is present in the config and add it to headers
            if (isset($config['x_api_key']) && !empty($config['x_api_key'])) {
            $headers[] = 'x-api-key: ' . $config['x_api_key'];
            }

            }

        // Check if 'Cookie' is present in the config and add it to headers
        if (isset($config['cookie']) && !empty($config['cookie'])) {
        $headers[] = 'Cookie: ' . $config['cookie'];
        }

            // If POST request, set up POST options
            curl_setopt_array($curl, [
                CURLOPT_URL => $config['api_url'] ?? '',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($replacedTemplate),
                CURLOPT_HTTPHEADER => $headers, // Use the dynamic headers array
            ]);
        } else {
            // If GET request, append query string to URL
            $query = http_build_query($replacedTemplate);
            curl_setopt_array($curl, [
                CURLOPT_URL => $config['api_url'] . '?' . $query,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);
        }

        // Execute cURL request and get response
        $response = curl_exec($curl);

        // Check for cURL errors
        if (curl_errno($curl)) {
            // Log cURL errors
            Log::channel('crm')->error('cURL error', [
                'clientId' => $clientId,
                'error' => curl_error($curl),
            ]);
        }

        // Close cURL resource
        curl_close($curl);

        return $response;
    }

}
?>
