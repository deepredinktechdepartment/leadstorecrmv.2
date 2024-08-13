<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ApiCredential;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

use App\Http\Controllers\ExternalDataController;
use App\Models\Client as Project;

class ApiCredentialController extends Controller
{
    //

 public function checkApiCredentials($projectID)
{

    return true;

    $ApiCredential_count=Project::where('id',$projectID)->get()->count();
    if($ApiCredential_count){
    $ApiCredential=Project::where('id',$projectID)->get()->first();
    // Use Eloquent to check if the API credentials exist
    $credentialsExist = Project::where('api_key', $ApiCredential->api_key)
    ->exists();
    if ($credentialsExist) {
    // API credentials exist, you can proceed with your logic
    return true;
    } else {
    // API credentials do not exist
    return false;
    }
    }
    else{
    return false;
    }

}

public function getApiCredentials($projectID)
{
    $ApiCredentialCount = Project::where('id', $projectID)->count();

    if ($ApiCredentialCount) {
        $ApiCredential = Project::where('id', $projectID)->first(['api_key']);

        // Use Eloquent to check if the API credentials exist
        $credentialsExist = Project::where('api_key', $ApiCredential->api_key)
            ->exists();

        if ($credentialsExist) {
            // API credentials exist, you can proceed with your logic
            $credentials = [
                'status' => 'success',
                'api_key' => $ApiCredential->api_key
            ];

            return response()->json($credentials);
        } else {
            // API credentials do not exist
            $errorResponse = [
                'status' => 'error',
                'message' => 'API credentials do not exist.',
            ];

            return response()->json($errorResponse);
        }
    } else {
        return response()->json(null);
    }
}



public function create(Request $request)
{
    try{

        $project=$request->projectID??null;
        $projectID=Crypt::decryptString($project);
        $Project=Project::find($projectID);
        $ApiCredential=ApiCredential::where('intranet_project_id',$projectID)->get()->first();
        $pageTitle="LeadStore Connect for ".$Project->name??'';
        return view('marketing.crm.api_credentials',compact('pageTitle','Project','ApiCredential','projectID'));
    }
    catch (\Exception $exception) {


        return redirect()->back()->with('error', 'Something went wrong.'.$exception->getMessage());
    }
}

public function store(Request $request)
{
    try{

        $projectID=$request->project;
        $Project=Project::find($projectID);
        $validationRules = ApiCredential::getValidationRules($projectID);
        $request->validate($validationRules);


        // Create/Update a new ApiCredential record with the provided data



        $ExternalDataController=new ExternalDataController();
        $filter_Data=$ExternalDataController->fetchfilteroptions($projectID);



        $ApiCredential=ApiCredential::updateOrInsert(
            [
                'org_id' =>$Project->org_id??0,
                'licence_id' => $Project->licence_id??0,
                'intranet_project_id' => $projectID??0,
            ],
            [
                'api_key' => $request->api_key??'',
                'org_id' =>$Project->org_id??0,
                'licence_id' => $Project->licence_id??0,
                'intranet_project_id' => $projectID??0,
                'added_by' =>  auth()->user()->id??0,
                'filter_options' =>$filter_Data??NULL,

            ]
        );

        if($ApiCredential){

        //return redirect('api-credentials/create/'.Crypt::encryptString($projectID))->with('success', 'API credentials saved successfully.');
        return redirect()->route('organizations.single.project', ['projectID'=>Crypt::encryptString($projectID)])->with('success','API credentials saved successfully');

    }else{
        return redirect()->back()->with('error', 'API credentials not  saved.');
        }

    }
    catch (\Exception $exception) {
    return redirect()->back()->with('error', 'Something went wrong.'.$exception->getMessage());
    }

}


public function update(Request $request)
{
    try{

        $project=$request->projectID??null;
        $projectID=Crypt::decryptString($project);
        $Project=Project::find($projectID);
        $ApiCredential=ApiCredential::where('intranet_project_id',$projectID)->get()->first();
        $pageTitle="Update LeadStore Connect for ".$Project->name??'';
        return view('marketing.crm.api_credentials',compact('pageTitle','Project','ApiCredential','projectID'));
    }
    catch (\Exception $exception) {


        return redirect()->back()->with('error', 'Something went wrong.'.$exception->getMessage());
    }
}
}
