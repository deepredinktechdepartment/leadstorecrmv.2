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
            $url = 'https://leadstore.in/api/get-filters-dropdown-options';
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
                $error="";
                $token = $api_key;
                $url = 'https://leadstore.in/api/deleteLeadfromexternal';

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
                $url = 'https://leadstore.in/api/updateLeadfromexternal';

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

            //$token = '';
            //$url = 'https://leadstore.in/api/get-leads';
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
    
     public function handleExternalPost(Request $request){
         
         dd(1);
        
        // Get a specific header value by header name
        $apiKey = $request->header('X-API-KEY');
        
        
$validator = \Validator::make($request->all(), [
    'firstName' => 'nullable|string|max:40',
    'lastName' => 'nullable|string|max:20',
    'email' => 'nullable:phoneNumber|email|max:100',
    'phoneNumber' => 'nullable:email|string|max:20',
    'countryCode' => 'nullable|string|max:5',
    'utm_source' => 'nullable|string|max:30',
    'utm_medium' => 'nullable|string|max:30',
    'utm_campaign' => 'nullable|string|max:50',
    'utm_term' => 'nullable|string|max:50',
    'utm_content' => 'nullable|string|max:50',
    'sourceURL' => 'nullable|string|max:255',
    'message' => 'nullable|string|max:255',
    'city' => 'nullable|string|max:255',
]);

$validator->sometimes('email', 'required_without:phoneNumber', function ($input) {
    return !$input->phoneNumber;
});

$validator->sometimes('phoneNumber', 'required_without:email', function ($input) {
    return !$input->email;
});


       if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        try {
        
        // Save lead data to the database
        //$lead = Lead::create($request->all());
        return $this->storeLead($request);
        
        } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
        }

    
    
    }
    
    


public function storeLead($request)
{
    try {
        $leadData = $request->all();
        
        

        // Fetch the client based on the provided apiKey
        $apiKey = $request->header('X-API-KEY');
        $client = Client::where('api_key', $apiKey)->first();

        if (!$client) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $clientId = $client->id;
        $isFRE=false;

        $udfArray = isset($leadData['UDF']) ? $leadData['UDF'] : [];
        $udfCount = count($udfArray);

        $existingLead = Lead::where(function ($query) use ($leadData) {
            $query->where('email', $leadData['email'])
                ->orWhere('phone', $leadData['phoneNumber']);
        })
            ->where('client_id', $clientId)
            ->first();

        $conversation = new Conversation();

        if ($existingLead) {
            $existingLead->utm_source = $leadData['utm_source']??null;
            $existingLead->utm_medium = $leadData['utm_medium']??null;
            $existingLead->utm_campaign = $leadData['utm_campaign']??null;
            $existingLead->utm_term = $leadData['utm_term']??null;
            $existingLead->utm_content = $leadData['utm_content']??null;
            
            $existingLead->lead_last_update_date = Carbon::now(); // Assuming 'addedon' is a timestamp/datetime column

            // Assign UDF values individually to model attributes
            for ($i = 0; $i < $udfCount && $i < 10; $i++) {
                $columnName = "udf" . ($i + 1);
                $existingLead->$columnName = json_encode($udfArray[$i]);
            }

            $leadSaveResult = $existingLead->save();
            $leadID = $existingLead->id;

            $conversation->client_id = $clientId;
            $conversation->leadid = $leadID;
            $conversation->lead_status = 'Existed Lead';
            $conversation->remark = 'Existed Lead Created';
            $conversation->description = 'Existed Lead Created#'.$leadID;
            $conversation->addedon = Carbon::now(); // Assuming 'addedon' is a timestamp/datetime column
            
        } else {
            $newLead = new Lead();
            $newLead->client_id = $clientId;
            $newLead->utm_source = $leadData['utm_source']??null;
            $newLead->utm_medium = $leadData['utm_medium']??null;
            $newLead->utm_campaign = $leadData['utm_campaign']??null;
            $newLead->utm_term = $leadData['utm_term']??null;
            $newLead->utm_content = $leadData['utm_content']??null;
            
            $newLead->firstname = $leadData['firstName']??null;
            $newLead->lastname = $leadData['lastName']??null;
            $newLead->email = $leadData['email']??null;
            $newLead->message = $leadData['message']??null;
            $newLead->city = $leadData['city']??null;
            $newLead->phone = $leadData['phoneNumber']??null;
            $newLead->phone_country_code = $leadData['countryCode']??null;
            $newLead->ua_query_url = $leadData['sourceURL']??null;
            $newLead->form_data = json_encode($leadData)??null;
            
            $newLead->registeredon = Carbon::now(); // Assuming 'addedon' is a timestamp/datetime column
            $newLead->lead_last_update_date = Carbon::now(); // Assuming 'addedon' is a timestamp/datetime column
            
            
            $newLead->status = 'New Lead';

            // Assign UDF values individually to model attributes
            for ($i = 0; $i < $udfCount && $i < 10; $i++) {
                $columnName = "udf" . ($i + 1);
                $newLead->$columnName = json_encode($udfArray[$i]);
            }

            $leadSaveResult = $newLead->save();
            $leadID = $newLead->id;

            $conversation->client_id = $clientId;
            $conversation->leadid = $leadID;
            $conversation->lead_status = 'New Lead';
            $conversation->remark = 'New Lead Created';
            $conversation->description = 'New Lead Created#'.$leadID;
            $conversation->addedon = Carbon::now(); // Assuming 'addedon' is a timestamp/datetime column
            
            
            // Your logic to determine $leadData and $isFRE
            $isFRE=true;
            //Mail::to("venkat@deepredink.com")->send(new LeadStoredMail($leadData, $isFRE));
            
        }

        if (!$leadSaveResult) {
            throw new \Exception('Failed to store lead');
        }

        $conversation->return_info = json_encode($leadData)??null;
        $conversation->addedby = "API";
        $conversationSaveResult = $conversation->save();

        if (!$conversationSaveResult) {
            throw new \Exception('Failed to store conversation');
        }
        
        
        // Your logic to determine $leadData and $isFRE
        //Mail::to("venkat@deepredink.com")->send(new LeadStoredMail($leadData, $isFRE));


    if ($existingLead) {
        return response()->json([
            'message' => 'Lead already exists',
            'lead_id' => $leadID
        ]);
    } else {
        return response()->json([
            'message' => 'Lead stored successfully',
            'lead_id' => $leadID
        ]);
    }  
        
        
    } catch (\Exception $e) {
        // Collect all exceptions and errors
        $errorMessages = [$e->getMessage()];

        while ($e->getPrevious()) {
            $e = $e->getPrevious();
            $errorMessages[] = $e->getMessage();
        }

        return response()->json(['errors' => $errorMessages], 500);
    }
}



}
