<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Client as Project; // Alias `Client` as `Project`
use App\Http\Controllers\ApiCredentialController;
use App\Models\Lead; // Assuming you have a Lead model
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ExternalDataController extends Controller
{

    public function fetchCRMLeads(Request $request){
            try {


            $projectID=$request->project_id??0;
            return redirect()->route('mkt.crm', ['projectID'=>Crypt::encryptString($projectID)]);

            } catch (\Exception $e) {
            return false;
            }

    }
    public function api_credentials_verification($projectID){
            try {

                $ApiCredentialController=new ApiCredentialController();
                return $ApiCredentialController->checkApiCredentials($projectID);

            } catch (\Exception $e) {
            return false;
            }

    }



    public function fetchfilteroptions($projectID)
    {
        try {




            if(!empty($projectID)){
                $projectID=$projectID;
            }
            else{
                $projectID=1;
            }

            $Is_verified=$this->api_credentials_verification($projectID);
            if($Is_verified){

        $ApiCredentialController=new ApiCredentialController();
        $ApiCredentials=$ApiCredentialController->getApiCredentials($projectID);
        $response = json_decode($ApiCredentials->getContent());
        $status = $response->status;
        $api_key = $response->api_key;


            if ($status === "success") {


            $Project=Project::find($projectID);
            $pageTitle=Str::title($Project->name??'')." Leads";
            $token = $api_key;
            // Set the request payload data, including the start date
            //$url = 'https://leadstore.in/api/get-filters-dropdown-options';
            $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->get($url);
            $status = $response->status();
            return $responseBody = $response->body(); // Get the response body
            } else {
            return redirect()->back()->with('error', 'api_key is exist in your database');
            }



        }
        else{

            return json_encode([]);

        }

        } catch (\Exception $e) {

            return json_encode([]);

        }
    }

    public function DeleteCRMRecord(Request $request){

        try{

            if(!empty($request->projectID)){
                $projectID=$request->projectID;
            }
            else{
                $projectID=0;
            }


            $Is_verified=$this->api_credentials_verification($projectID);
            if($Is_verified){

            $ApiCredentialController=new ApiCredentialController();
            $ApiCredentials=$ApiCredentialController->getApiCredentials($projectID);
            $response = json_decode($ApiCredentials->getContent());
            $status = $response->status;
            $api_key = $response->api_key;

                if ($status === "success") {
                $Lead_ID=$request->record_id??null;
                $error="";
                $token = $api_key;
                $url = env('APP_URL').'api/deleteLeadfromexternal';

                $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                ])->get($url,
                [
                'Lead_ID' => $Lead_ID
                ]
                );
                $status = $response->status();
                $responseBody = $response->body(); // Get the response body
                return $responseBody;

                } else {
                return redirect()->back()->with('error', 'api_key is exist in your database');
                }

        }
        else{
            return json_encode([]);
        }



        } catch (\Exception $e) {

            return json_encode([]);

        }
    }



     public function UpdateCRMRecord(Request $request){

        try{

            if(!empty($request->projectID)){
                $projectID=$request->projectID;
            }
            else{
                $projectID=1;
            }

            $Is_verified=$this->api_credentials_verification($projectID);
            if($Is_verified){

           $ApiCredentialController=new ApiCredentialController();
            $ApiCredentials=$ApiCredentialController->getApiCredentials($projectID);
            $response = json_decode($ApiCredentials->getContent());
            $status = $response->status;
            $api_key = $response->api_key;

                if ($status === "success") {
                $Lead_ID=$request->record_id??null;
                $remark=$request->remark??null;
                $lead_status=$request->lead_status??null;
                $error="";
                $token = $api_key;
                $url = env('APP_URL').'api/updateLeadfromexternal';

                $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                ])->get($url,
                [
                'Lead_ID' => $Lead_ID,
                'remark' => $remark,
                'lead_status' => $lead_status,
                ]
                );
                $status = $response->status();
                $responseBody = $response->body(); // Get the response body
                return $responseBody;
                } else {
                return redirect()->back()->with('error', 'api_key is exist in your database');
                }

        }
        else{
            return json_encode([]);
        }

        } catch (\Exception $e) {
            return json_encode([]);

        }
    }



     public function SingleLeadData(Request $request)
    {
        try {


            if(!empty($request->projectID)){
                $projectID=$request->projectID;
            }
            else{
                $projectID=1;
            }



            $Is_verified=$this->api_credentials_verification($projectID);
            if($Is_verified){

                $ApiCredentialController=new ApiCredentialController();
                $ApiCredentials=$ApiCredentialController->getApiCredentials($projectID);
                $response = json_decode($ApiCredentials->getContent());
                $status = $response->status;
                $api_key = $response->api_key;

                if ($status === "success") {

            $Project=Project::find($projectID);
            $Lead_ID=$request->leadID??null;
            $pageTitle="#".$Lead_ID." Lead Details";
            $error="";
            $token = $api_key;





            //$token = '';
            $url = env('APP_URL').'api/getsingleleadData';

            $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->get($url,
            [
            'Lead_ID' => $Lead_ID,

            // Add more query parameters as needed
            ]
            );
            $status = $response->status();
            $responseBody = $response->body(); // Get the response body




            if ($response->successful()) {
            $leadData = $response->json()??[];
            // Process the JSON data here
            return view('marketing.crm.single_lead_info',compact('pageTitle','leadData','error','projectID'));
            } else {

            $error=['error' => 'Error fetching data from external API'.$responseBody];
            $leadData="";
            return view('marketing.crm.single_lead_info',compact('pageTitle','leadData','error','projectID'));
            //return response()->json(['error' => 'Error fetching data from external API'.$responseBody], $status);
            }

        } else {
        return redirect()->back()->with('error', 'api_key is exist in your database');
        }



        }
        else{

            return redirect('/api-credentials/create/'.Crypt::encryptString($projectID));

        }

        } catch (\Exception $e) {
            $error=['error' => 'An error occurred: ' . $e->getMessage()];
            $Jdata="";
            return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID'));
           //return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);


        }
    }


 public function fetchDataFromExternalAPI(Request $request)
    {
        try {



            if(!empty($request->projectID)){
                $projectID=Crypt::decrypt($request->projectID);
            }
            else{
                $projectID=0;
            }


            $Project=Project::find($projectID);
            $pageTitle=$Project->client_name." Leads";
            $startDate = $request->start_date??date('Y-m-01');
            $endDate = $request->end_date??date('Y-m-d');
            $utmCampaign = $request->utm_campaign??null;
            $utmMedium = $request->utm_medium??null;
            $utmSource = $request->utm_source??null;
            $utmStatus = $request->status??null;


            $Is_verified=$this->api_credentials_verification($projectID);




            if($Is_verified){


                $ApiCredentialController=new ApiCredentialController();
                $ApiCredentials=$ApiCredentialController->getApiCredentials($projectID);
                $response = json_decode($ApiCredentials->getContent());

                $status = $response->status;
                $api_key = $response->api_key;

                if ($status === "success") {

            $error="";
            $token = $api_key;
            $url = env('APP_URL').'api/getleads';

            $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->get($url,
            [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'utm_campaign' => $utmCampaign,
            'utm_medium' => $utmMedium,
            'utm_source' => $utmSource,
            'status' => $utmStatus,
            'testparam' => "test",
            // Add more query parameters as needed
            ]
            );
            $status = $response->status();
            $responseBody = $response->body(); // Get the response body


            $today_count=$monthly_count=0;


            if ($response->successful()) {
            $data = $response->json();



            // Process the JSON data here
            $leadCount_source = $data['leadCount_source']??[]; // Your data here


            $Jdata = $data['leads']??[]; // Your data here

            $today_count = $data['today_count']??0; // Your data here
            $monthly_count = $data['monthly_count']??0; // Your data here
            $utmData['getUniqueUtmValues']=[
                'utm_sources'=>$data['utm_sources']??[],
                'utm_mediums'=>$data['utm_mediums']??[],
                'utm_campaigns'=>$data['utm_campaigns']??[],

                ];

            return view('marketing.crm.leads',compact('utmData','pageTitle','Jdata','error','today_count','monthly_count','leadCount_source','token','projectID','startDate','endDate','utmCampaign','utmMedium','utmSource','utmStatus'));
            } else {


            $error=['error' => 'Error fetching data from external API'.$responseBody];
            $Jdata="";
            $leadCount_source="";
            $pageTitle="";
            $utmData=[];
            return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID','today_count','monthly_count','leadCount_source','startDate','endDate','utmCampaign','utmMedium','utmSource','utmStatus'));
            //return response()->json(['error' => 'Error fetching data from external API'.$responseBody], $status);
            }

        } else {
        return redirect()->back()->with('error', 'api_key is exist in your database');
        }



        }
        else{

            $pageTitle="";
           // return redirect('/api-credentials/create/'.Crypt::encryptString($projectID));
           return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID','today_count','monthly_count','leadCount_source','startDate','endDate','utmCampaign','utmMedium','utmSource','utmStatus'));

        }

        } catch (\Exception $e) {
            $error=['error' => 'An error occurred: ' . $e->getMessage()];
            $Jdata="";
            $pageTitle=$projectID="";
            return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID'));
           //return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);


        }
    }



 public function getLeads(Request $request)
{
    // Get the 'Authorization' header from the incoming request
    $authorizationHeader = $request->header('Authorization');

    // Extract token from the Authorization header
    $token = $this->extractToken($authorizationHeader);

    // Validate the token
    $clientID = $this->validateToken($token);

    if (!$clientID) {
        return response()->json(['message' => 'Invalid authorization token'], 401);
    }

    // Retrieve input parameters
    $startDate = $request->query('start_date'); // Get the 'start_date' query parameter
    $endDate = $request->query('end_date'); // Get the 'end_date' query parameter
    $utmCampaign = $request->query('utm_campaign'); // Get the 'utm_campaign' query parameter
    $utmMedium = $request->query('utm_medium'); // Get the 'utm_medium' query parameter
    $utmSource = $request->query('utm_source'); // Get the 'utm_source' query parameter
    $status = $request->query('status'); // Get the 'status' query parameter

    // Fetch leads based on the input parameters
    $leads = $this->fetchLeads($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status);

    // Fetch distinct UTM values
    $utmSources = $this->fetchDistinctUtmSource($clientID);
    $utmMediums = $this->fetchDistinctUtmMedium($clientID);
    $utmCampaigns = $this->fetchDistinctUtmCampaign($clientID);

    // Fetch lead counts by UTM source
    $leadCounts = $this->fetchLeadCountsByUtmSource($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status);

    // Get today's and monthly leads count
    $todayCount = $this->fetchTodayLeadsCount($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status);
    $monthlyCount = $this->fetchMonthlyLeadsCount($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status);

    // Check if any leads were found
    if (empty($leads)) {
        // No leads found
        $response = [
            'leadCount_source' => $leadCounts,
            'status' => 'error',
            'message' => 'No leads found',
            'today_count' => $todayCount,
            'monthly_count' => $monthlyCount,
            'params' => [
                'sdate' => $startDate ?? '',
                'edate' => $endDate ?? ''
            ],
            'projectId' => $clientID ?? 0,
            'leads' => $leads,
            'utm_sources' => $utmSources,
            'utm_mediums' => $utmMediums,
            'utm_campaigns' => $utmCampaigns,
        ];
    } else {
        // Leads found
        $response = [
            'leadCount_source' => $leadCounts,
            'status' => 'success',
            'message' => 'Leads found',
            'today_count' => $todayCount,
            'monthly_count' => $monthlyCount,
            'params' => [
                'sdate' => $startDate ?? '',
                'edate' => $endDate ?? ''
            ],
            'projectId' => $clientID ?? 0,
            'leads' => $leads,
            'utm_sources' => $utmSources,
            'utm_mediums' => $utmMediums,
            'utm_campaigns' => $utmCampaigns,
        ];
    }

    return response()->json($response);
}

 public function getSingleLeadData(Request $request)
    {
        // Get the Authorization header
       $authorizationHeader = $request->header('Authorization');
    $leadId = $request->query('Lead_ID'); // For query parameters

        // Extract the token from the Authorization header
        $token = $this->extractToken($authorizationHeader);

        // Check if the token is present
        if (!$token) {
            return response()->json(['message' => 'Authorization header missing'], 401);
        }

        // Validate the token
        $clientID = $this->validateToken($token);

        if (!$clientID) {
            return response()->json(['message' => 'Invalid authorization token'], 401);
        }

        // Fetch the single lead data
       $singleLeadData = $this->fetchSingleLead($clientID, $leadId);



        $numRows = $singleLeadData['numRows'];
        $leadData = $singleLeadData['leadData'];
        $conversations = $singleLeadData['conversations'];

        if ($numRows > 0) {
            $response = [
                'status' => 'success',
                'message' => 'Leads found',
                'leads' => $leadData,
                'conversations' => $conversations,
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No leads found',
                'leads' => '',
                'conversations' => '',
            ];
            return response()->json($response);
        }
    }

protected function fetchSingleLead($clientID, $leadId)
    {
        try {
            // Fetch lead data
            $lead = Lead::where('id', $leadId)->get();
            $leadCount = $lead->count(); // Count of leads

            // Fetch related conversations
            $conversations = Conversation::where('client_id', $clientID)
                                          ->where('leadid', $leadId) // Assuming 'lead_id' is the foreign key in Conversation model
                                          ->get();



            return [
                'numRows' =>$leadCount, // There is a lead found
                'leadData' => $lead,
                'conversations' => $conversations,
                'conversationsCount' => $conversations->count(), // Count of related conversations
            ];
        } catch (ModelNotFoundException $e) {
            // Handle case where the lead is not found
            return [
                'numRows' => 0,
                'leadData' => null,
                'conversations' => null,
                'conversationsCount' => 0,
                'error' => 'Lead not found'
            ];
        } catch (\Exception $e) {
            // Handle any other exceptions
            return [
                'numRows' => 0,
                'leadData' => null,
                'conversations' => null,
                'conversationsCount' => 0,
                'error' => 'An error occurred: ' . $e->getMessage()
            ];
        }
    }


    private function extractToken($authorizationHeader)
    {

        $authorizationHeader = $authorizationHeader;

        if (strpos($authorizationHeader, 'Bearer ') === 0) {
            return substr($authorizationHeader, 7);
        }

        return response()->json(['message' => 'Authorization header missing'], 401)->send();
        exit; // Terminate further execution
    }

 private function validateToken($token)
    {
        // Query the clients table for the given API key
        $client = Project::where('api_key', $token)->first();

        // Check if a client with this API key was found
        if ($client) {
            return $client->id; // Return the client's ID
        } else {
            return false; // Token is invalid
        }
    }

    private function fetchLeads($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status)
    {
        return Lead::where('client_id', $clientID)
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('lead_last_update_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('lead_last_update_date', '<=', $endDate);
            })
            ->when($utmCampaign, function ($query, $utmCampaign) {
                return $query->where('utm_campaign', $utmCampaign);
            })
            ->when($utmMedium, function ($query, $utmMedium) {
                return $query->where('utm_medium', $utmMedium);
            })
            ->when($utmSource, function ($query, $utmSource) {
                return $query->where('utm_source', $utmSource);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
             ->orderBy('lead_last_update_date', 'desc') // Order by lead_last_update_date in descending order

            ->get();
    }

    private function fetchDistinctUtmSource($clientID)
    {
        return Lead::where('client_id', $clientID)
            ->distinct()
            ->pluck('utm_source')
            ->filter()
            ->sort()
            ->values()
            ->all();
    }

    private function fetchDistinctUtmMedium($clientID)
    {
        return Lead::where('client_id', $clientID)
            ->distinct()
            ->pluck('utm_medium')
            ->filter()
            ->sort()
            ->values()
            ->all();
    }

    private function fetchDistinctUtmCampaign($clientID)
    {
        return Lead::where('client_id', $clientID)
            ->distinct()
            ->pluck('utm_campaign')
            ->filter()
            ->sort()
            ->values()
            ->all();
    }

    private function fetchLeadCountsByUtmSource($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status)
    {
        return Lead::where('client_id', $clientID)
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('lead_last_update_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('lead_last_update_date', '<=', $endDate);
            })
            ->when($utmCampaign, function ($query, $utmCampaign) {
                return $query->where('utm_campaign', $utmCampaign);
            })
            ->when($utmMedium, function ($query, $utmMedium) {
                return $query->where('utm_medium', $utmMedium);
            })
            ->when($utmSource, function ($query, $utmSource) {
                return $query->where('utm_source', $utmSource);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->select('utm_source', \DB::raw('count(*) as lead_count'))
            ->groupBy('utm_source')
            ->get()
            ->map(function ($item) {
                return [
                    'utm_source' => $item->utm_source,
                    'lead_count' => $item->lead_count,
                ];
            })
            ->all();
    }

    private function fetchTodayLeadsCount($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status)
    {
        return Lead::where('client_id', $clientID)
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('lead_last_update_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('lead_last_update_date', '<=', $endDate);
            })
            ->when($utmCampaign, function ($query, $utmCampaign) {
                return $query->where('utm_campaign', $utmCampaign);
            })
            ->when($utmMedium, function ($query, $utmMedium) {
                return $query->where('utm_medium', $utmMedium);
            })
            ->when($utmSource, function ($query, $utmSource) {
                return $query->where('utm_source', $utmSource);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->whereDate('lead_last_update_date', now()->toDateString())
            ->count();
    }

    private function fetchMonthlyLeadsCount($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status)
    {
        return Lead::where('client_id', $clientID)
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('lead_last_update_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('lead_last_update_date', '<=', $endDate);
            })
            ->when($utmCampaign, function ($query, $utmCampaign) {
                return $query->where('utm_campaign', $utmCampaign);
            })
            ->when($utmMedium, function ($query, $utmMedium) {
                return $query->where('utm_medium', $utmMedium);
            })
            ->when($utmSource, function ($query, $utmSource) {
                return $query->where('utm_source', $utmSource);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->whereMonth('lead_last_update_date', now()->month)
            ->count();
    }

  public function handleExternalPost(Request $request)
{
    // Get a specific header value by header name
    $apiKey = $request->header('X-API-KEY');

    // Define the validation rules
    $validator = \Validator::make($request->all(), [
        'firstName' => 'required|string|max:50',
        'api_key' => 'required', // Mandatory and integer validation
        'email' => 'required|email|max:100',
        'phoneNumber' => 'required|string|max:20',
        'utm_source' => 'nullable|string|max:80',
        'lastName' => 'nullable|string|max:20',
        'countryCode' => 'required|string|max:5',
        'utm_medium' => 'nullable|string|max:80',
        'utm_campaign' => 'nullable|string|max:80',
        'utm_term' => 'nullable|string|max:80',
        'utm_content' => 'nullable|string|max:100',
        'sourceURL' => 'nullable|string',
        'message' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',

    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        // Save lead data to the database
        $lead = $this->storeLead($request);

        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => $lead['message'],
            'lead_id' => $lead['lead_id'],
        ], $lead['status_code']);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'success' => false,
            'message' => 'An error occurred while processing your request',
            'error' => $e->getMessage(),
        ], 500);
    }
}

public function storeLead($request)
{
    try {
        $leadData = $request->all();

        // Fetch the client based on the provided apiKey
        $apiKey =  $leadData['api_key']??'';
        $client = Project::where('api_key', $apiKey)->first();

        if (!$client) {
            throw new \Exception('Unauthorized access');
        }

        $clientId = $client->id;
        $isFRE = false;

        $udfArray = isset($leadData['UDF']) ? $leadData['UDF'] : null;
        $utmDetails = [
            'utm_source' => $leadData['utm_source'] ?? 'direct',
            'utm_medium' => $leadData['utm_medium'] ?? 'web',
            'utm_campaign' => $leadData['utm_campaign'] ?? null,
            'utm_term' => $leadData['utm_term'] ?? null,
            'utm_content' => $leadData['utm_content'] ?? null,
        ];

        $existingLead = Lead::where(function ($query) use ($leadData) {
            $query->where('email', $leadData['email'])
                ->orWhere('phone', $leadData['phoneNumber']);
        })
            ->where('client_id', $clientId)
            ->first();

        $conversation = new Conversation();
        $leadMessage = '';

        if ($existingLead) {
            // Update existing lead
            $this->updateExistingLead($existingLead, $leadData, $udfArray);
            $leadID = $existingLead->id;
            $leadMessage = 'Lead already exists';

            $conversation->client_id = $clientId;
            $conversation->leadid = $leadID;
            $conversation->lead_status = 'existing_lead';
            $conversation->remark = 'Existing Lead Updated';
            $conversation->description = 'Existing Lead Updated#' . $leadID;
        } else {
            // Create new lead
            $newLead = new Lead();
            $this->createNewLead($newLead, $leadData, $udfArray, $clientId);
            $leadID = $newLead->id;
            $leadMessage = 'New Lead created successfully';

            $conversation->client_id = $clientId;
            $conversation->leadid = $leadID;
            $conversation->lead_status = 'lead_created';
            $conversation->remark = 'New Lead Created';
            $conversation->description = 'New Lead Created#' . $leadID;

            $isFRE = true;
            //Mail::to("venkat@deepredink.com")->send(new LeadStoredMail($leadData, $isFRE));
        }

        $conversation->return_info = json_encode($leadData) ?? null;
        $conversation->utm_details = json_encode($utmDetails) ?? null;
        $conversation->udf_details = json_encode($udfArray) ?? null;
        $conversation->addedby = "API";
        $conversation->addedon = Carbon::now(); // Assuming 'addedon' is a timestamp/datetime column
        $conversation->save();

        return [
            'status_code' => $existingLead ? 200 : 201,
            'message' => $leadMessage,
            'lead_id' => $leadID,
        ];
    } catch (\Exception $e) {
        throw $e;
    }
}

protected function updateExistingLead($existingLead, $leadData, $udfArray)
{
    $existingLead->utm_source = $leadData['utm_source'] ?? 'direct';
    $existingLead->utm_medium = $leadData['utm_medium'] ?? 'web';
    $existingLead->utm_campaign = $leadData['utm_campaign'] ?? null;
    $existingLead->utm_term = $leadData['utm_term'] ?? null;
    $existingLead->utm_content = $leadData['utm_content'] ?? null;
    $existingLead->udf_details = json_encode($udfArray) ?? null;
    $existingLead->lead_last_update_date = Carbon::now();
    $existingLead->save();
}

protected function createNewLead($newLead, $leadData, $udfArray, $clientId)
{
    $newLead->client_id = $clientId;
    $newLead->utm_source = $leadData['utm_source'] ?? 'direct';
    $newLead->utm_medium = $leadData['utm_medium'] ?? 'web';
    $newLead->utm_campaign = $leadData['utm_campaign'] ?? null;
    $newLead->utm_term = $leadData['utm_term'] ?? null;
    $newLead->utm_content = $leadData['utm_content'] ?? null;
    $newLead->udf_details = json_encode($udfArray) ?? null;

    $newLead->firstname = $leadData['firstName'] ?? null;
    $newLead->lastname = $leadData['lastName'] ?? null;
    $newLead->email = $leadData['email'] ?? null;
    $newLead->message = $leadData['message'] ?? null;
    $newLead->city = $leadData['city'] ?? null;
    $newLead->phone = isset($leadData['phoneNumber']) ? str_replace(' ', '', $leadData['phoneNumber']) : null;
    $newLead->phone_country_code = $leadData['countryCode'] ?? null;
    $newLead->ua_query_url = $leadData['sourceURL'] ?? null;
    $newLead->form_data = json_encode($leadData) ?? null;

    $newLead->registeredon = Carbon::now();
    $newLead->lead_last_update_date = Carbon::now();
    $newLead->status = 'lead_created';

    $newLead->save();
}



public function deleteLead(Request $request)
{
    // Get the Authorization header
    $authorizationHeader = $request->header('Authorization');
    $leadId = $request->query('Lead_ID'); // For query parameters

    // Extract the token from the Authorization header
    $token = $this->extractToken($authorizationHeader);

    // Check if the Authorization header is present
    if (!$token) {
        return response()->json(['message' => 'Authorization header missing'], 401);
    }

    // Validate the token (implement your validation logic here)
    if (!$this->validateToken($token)) {
        return response()->json(['message' => 'Invalid authorization token'], 401);
    }

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Attempt to delete the lead record
        $lead = Lead::find($leadId);

        if ($lead) {
            // Delete the lead record
            $lead->delete();

            // Attempt to delete related conversation records
            Conversation::where('leadid', $leadId)->delete();

            // Commit the transaction
            DB::commit();

            // Record was deleted successfully
            return response()->json([
                'status' => 'success',
                'message' => 'Data deleted',
                'Lead_ID' => $leadId,
            ]);
        } else {
            // Record not found
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Lead not found',
                'Lead_ID' => $leadId,
            ], 404);
        }
    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();
        // Log the exception or handle it accordingly
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred: ' . $e->getMessage(),
        ], 500);
    }
}

public function updateLead(Request $request)
{
    // Get the Authorization header
    $authorizationHeader = $request->header('Authorization');
    $leadId = $request->query('Lead_ID');
    $remark = $request->query('remark');
    $leadStatus = $request->query('lead_status');



    // Extract token from Authorization header
    $token = $this->extractToken($authorizationHeader);

    // Check if the Authorization header is present
    if (!$token) {
        return response()->json(['message' => 'Authorization header missing'], 401);
    }

    // Validate the token
    if (!$this->validateToken($token)) {
        return response()->json(['message' => 'Invalid authorization token'], 401);
    }

    try {
        // Find the lead record
        $lead = Lead::find($leadId);

        if (!$lead) {
            return response()->json(['status' => 'error', 'message' => 'Lead not found'], 404);
        }


            $lead->status = $leadStatus;
            // Update other fields individually
            $lead->save();





    $conversation = new Conversation();
    $conversation->leadid = $leadId;
    $conversation->lead_status = $leadStatus;
    $conversation->remark = $remark;
    $conversation->addedon = Carbon::now();
    $conversation->addedby = 'API';
    $conversation->client_id = $this->validateToken($token);
    $conversation->save();


        // Success response
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated',
            'Lead_ID' => $leadId,
        ]);
    } catch (\Exception $e) {
        // Error response
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while updating the lead record'.$e->getMessage(),
            'error' => $e->getMessage(),
        ], 500);
    }
}




}
