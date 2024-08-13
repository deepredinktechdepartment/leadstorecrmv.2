<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Client as Project; // Alias `Client` as `Project`
use App\Http\Controllers\ApiCredentialController;
use App\Models\Lead; // Assuming you have a Lead model
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
            $url = 'https://leadstore.in/api/get-singlelead-data';

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
            $url = 'https://alpha.leadstore.in/crmv.2/api/get-leads';

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
            dd($response->json());

            if ($response->successful()) {
            $data = $response->json();
        
        
            dd($data);
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
         return $authorizationHeader = $request->Authorization;

        // Extract token from the Authorization header
    
        $token = $this->extractToken($request);

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
        
        return $startDate;

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

        // Prepare and return the response
        $response = [
            'leadCount_source' => $leadCounts,
            'status' => 'success',
            'message' => 'Leads found',
            'today_count' => $todayCount,
            'monthly_count' => $monthlyCount,
            'params' => ["sdate" => $startDate ?? '', "edate" => $endDate ?? ''],
            'projectId' => $clientID ?? 0,
            'leads' => $leads,
            'utm_sources' => $utmSources,
            'utm_mediums' => $utmMediums,
            'utm_campaigns' => $utmCampaigns,
        ];

        return response()->json($response);
    }

    private function extractToken(Request $request)
    {
        $authorizationHeader = $request->header('Authorization');
        if (strpos($authorizationHeader, 'Bearer ') === 0) {
            return substr($authorizationHeader, 7);
        }

        return response()->json(['message' => 'Authorization header missing'], 401)->send();
        exit; // Terminate further execution
    }

    private function validateToken($token)
    {
        // Implement your token validation logic here
        // Return the clientID if the token is valid, otherwise return false

        return $clientID; // Placeholder for actual logic
    }

    private function fetchLeads($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status)
    {
        return Lead::where('client_id', $clientID)
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
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
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
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
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
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
            ->whereDate('created_at', now()->toDateString())
            ->count();
    }

    private function fetchMonthlyLeadsCount($clientID, $startDate, $endDate, $utmCampaign, $utmMedium, $utmSource, $status)
    {
        return Lead::where('client_id', $clientID)
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
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
            ->whereMonth('created_at', now()->month)
            ->count();
    }

}
