<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\Client as Project; // Alias `Client` as `Project`
use App\Http\Controllers\ApiCredentialController;

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
            $url = 'https://leadstore.in/api/get-leads';


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

            return view('marketing.crm.leads',compact('pageTitle','Jdata','error','today_count','monthly_count','leadCount_source','token','projectID','startDate','endDate','utmCampaign','utmMedium','utmSource','utmStatus'));
            } else {


            $error=['error' => 'Error fetching data from external API'.$responseBody];
            $Jdata="";
            $leadCount_source="";
            return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID','today_count','monthly_count','leadCount_source','startDate','endDate','utmCampaign','utmMedium','utmSource','utmStatus'));
            //return response()->json(['error' => 'Error fetching data from external API'.$responseBody], $status);
            }

        } else {
        return redirect()->back()->with('error', 'api_key is exist in your database');
        }



        }
        else{

           // return redirect('/api-credentials/create/'.Crypt::encryptString($projectID));
           return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID','today_count','monthly_count','leadCount_source','startDate','endDate','utmCampaign','utmMedium','utmSource','utmStatus'));

        }

        } catch (\Exception $e) {
            $error=['error' => 'An error occurred: ' . $e->getMessage()];
            $Jdata="";
            return view('marketing.crm.leads',compact('pageTitle','Jdata','error','projectID'));
           //return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);


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



}
