<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;
use App\Models\Organizations;
use App\Models\GroupLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;
use Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Carbon;
Use Exception;
use Illuminate\Support\Facades\Crypt;
use Config;
use Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
class ClientController extends Controller
{
// Display a listing of the resource.

public function index(Request $request)
{
    $pageTitle = 'Projects List'; // Set the page title
    $clients = [];
    $addlink = route('clients.create');

    try {
        // Initialize the query builder
        $query = Client::mappedToUser()->select('clients.*')
            ->orderBy('clients.active', 'DESC')
            ->orderBy('clients.client_name');

        // Check if 'active' query parameter is present
        if ($request->has('active')) {
            $active = $request->input('active');

            // Normalize the value to boolean
            $isActive = filter_var($active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            if ($isActive !== null) {
                $query->where('clients.active', $isActive);
            }
        }

        // Execute the query
        $clients = $query->get();
    } catch (\Exception $e) {
        // Log the exception message
        \Log::error('Failed to retrieve clients: ' . $e->getMessage());
        // Optionally, set a user-friendly error message
        return view('clients.index', ['pageTitle' => $pageTitle, 'error' => 'An error occurred while fetching clients.']);
    }

    return view('clients.index', compact('clients', 'pageTitle', 'addlink'));
}


    // Show the form for creating a new resource.

    public function create()
    {
        try {
            // Set the page title
            $pageTitle = 'Create New Project';
            $client = new Client(); // Create an empty instance for the form
            // Return the view with the page title
            return view('clients.create', compact('pageTitle','client'));
        } catch (\Exception $e) {

            // Optionally, redirect to a different page or show an error message
            return redirect()->route('clients.index')->with('error', 'An error occurred while trying to display the form.');
        }
    }




    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string|max:20',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    // Display the specified resource.
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }


    public function edit(Request $request)
{
    try {

        $encryptedId=$request->client;
        // Decrypt the client ID
        $clientId = Crypt::decrypt($encryptedId);

        $client = Client::findOrFail($clientId);

        // Check if the 'social_media_pages' column contains data and decode it, otherwise set a default array
        $client->social_media_pages = $client->social_media_pages
            ? json_decode($client->social_media_pages, true)
            : [
                'facebook' => '',
                'twitter' => '',
                'linkedin' => '',
                'instagram' => '',
                'api_url' => '',
            ];


        // Set the page title
        $pageTitle = 'Edit Project';

        // Return the view with the client data and page title
        return view('clients.create', compact('client', 'pageTitle'));
    } catch (\Exception $e) {
        // Log the error message
        \Log::error('Error retrieving client for edit: ' . $e->getMessage());

        // Redirect to the clients index page with an error message
        return redirect()->route('clients.index')->with('error', 'An error occurred while trying to display the edit form.');
    }
}



    // Update the specified resource in storage.
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }





public function destroy($encryptedId)
{
    try {
        // Decrypt the client ID
        $id = Crypt::decrypt($encryptedId);

        // Find the client by ID
        $client = Client::findOrFail($id);

        // Check if a file associated with the client exists and delete it
        if ($client->logo && Storage::exists($client->logo)) {
            Storage::delete($client->logo);
        }

        // Delete the client record
        $client->delete();

        // Redirect with a success message
        return redirect()->route('clients.index')->with('success', 'Project deleted successfully.');

    } catch (\Exception $e) {
        // Log the error message
        \Log::error('Error deleting Project: ' . $e->getMessage());

        // Redirect with an error message
        return redirect()->route('clients.index')->with('error', 'An error occurred while trying to delete the Project.');
    }
}
    public function projectSetting(Request $request)
{


    $clientId = Crypt::decrypt($request->projectID);
    $client = Client::findOrFail($clientId);

    return view('clients.settings', compact('client'));
}

    // Store or update a client
    public function save(Request $request, $id = null)
    {

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:150',
            'industry' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'domain' => 'nullable|url|max:255',
            'pan' => 'nullable|string|max:10',
            'tan' => 'nullable|string|max:10',
            'social_media' => 'nullable|string|max:255',
            'api_url' => 'nullable|url|max:255',
            'logo' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'], // Validate image
        ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $errorMessage = implode(', ', $errors);
        return redirect()->back()->with('error', $errorMessage)->withInput();
    }

        try {
            // If $id is provided, find the client for update; otherwise, create a new instance



            $client = $id ? Client::findOrFail(Crypt::decrypt($id)) : new Client;


            // Assign values to client properties
            $client->client_name = $request->name;
            $client->short_name = $request->short_name;

            // Set logo path if available
            if ($request->hasFile('logo')) {
                // Store the new logo and get the file path
                $file = $request->file('logo');
                $path = $file->store('logos', 'public');

                // If a logo already exists, delete the old file
                if ($client->client_logo && Storage::exists('public/' . $client->client_logo)) {
                    Storage::delete('public/' . $client->client_logo);
                }

                // Save the new logo path in the database
                $client->client_logo = $path;
            }


            $client->industry_category = $request->industry;

                // Serialize the social media URLs into a JSON object
                $client->social_media_pages = json_encode([
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'linkedin' => $request->input('linkedin'),
                'instagram' => $request->input('instagram'),
                'api_url' => $request->input('api_url'),
                ]);




            $client->client_address1 = $request->address1;
            $client->client_address2 = $request->address2;
            $client->client_city = $request->city;
            $client->client_state = $request->state;
            $client->zip_code = $request->zip;
            $client->client_webpage = $request->domain;
            $client->client_pan = $request->pan;
            $client->client_tan = $request->tan;

               // Save CRM Merchant ID and API Key in their respective columns

    $client->api_key = $request->input('crm_api_key', '');

            $client->save();

            // Redirect with success message
            $message = $id ? 'Project updated successfully!' : 'Project created successfully!';
            return redirect()->route('clients.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error saving project: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while saving the project.');
        }
    }

    // Method to handle status updates via AJAX
    public function updateStatus(Request $request)
    {
        $clientId = $request->input('id');
        $isActive = $request->input('active');


        try {
            // Decrypt the client ID
            $decryptedId = $clientId;

            // Find the client
            $client = Client::findOrFail($decryptedId);
            // Update the status
            $client->active = $isActive;
            $client->save();

            return response()->json([
                'success' => true,
                'message' => 'Client status updated successfully.',
            ]);
        } catch (\Exception $e) {
            // Handle the exception if the client is not found or decryption fails
            return response()->json([
                'success' => false,
                'message' => 'Failed to update client status.'.$e->getmessage(),
            ]);
        }
    }


    public function dashboard($clientID = null)
    {
        return $this->underConstruction($clientID);
    }

    public function facebook($clientID = null)
    {

            try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'Facebook Connect';
            // Return the view with the client data and page title
            return view('facebook.index', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }



    }

    public function facebookPages($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land Facebook Pages';
            // Return the view with the client data and page title
            return view('facebook.facebookPages', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function competitorScores($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land Competitor Scores';
            // Return the view with the client data and page title
            return view('facebook.competitorScores', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function exotel($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land Exotel Connect';
            // Return the view with the client data and page title
            return view('cloudTelephony.index', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }



    public function firstResponseEmailer($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land First Response Emailer';
            // Return the view with the client data and page title
            return view('email.firstResponseEmailer', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function leadNotifications($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land Lead Notifications';
            // Return the view with the client data and page title
            return view('email.leadNotifications', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function freTemplate($clientID = null)
{
    try {
        // Check if clientID is encrypted and decrypt if necessary
        $id = $clientID;
        if (isEncrypted($clientID)) {
            $id = Crypt::decrypt($clientID);
        }

        // Find the client by ID, handle case if not found
        $client = Client::find($id);

        if (!$client) {
            // Client does not exist, redirect with error message
            return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                             ->with('error', 'Client not found.');
        }

        // Set the page title, including the client name
        $pageTitle = 'FRE Emailer Template for ' . $client->client_name;

        // Return the view with the client data and page title
        return view('email.freTemplate', compact('pageTitle', 'client'));
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Error in freTemplate: ' . $e->getMessage(), ['clientID' => $clientID]);

        // Redirect to the clients index page with an error message
        return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                         ->with('error', 'An error occurred while trying to display the FRE template.');
    }
}


    public function leadNotificationTemplate($clientID = null)
    {



        try {
            // Check if clientID is encrypted and decrypt if necessary
            $id = $clientID;
            if (isEncrypted($clientID)) {
                $id = Crypt::decrypt($clientID);
            }

            // Find the client by ID, handle case if not found
            $client = Client::find($id);

            if (!$client) {
                // Client does not exist, redirect with error message
                return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                                 ->with('error', 'Client not found.');
            }

            // Set the page title, including the client name
            $pageTitle = 'Lead Notification Template for ' . $client->client_name;

            // Return the view with the client data and page title
            return view('email.leadNotificationTemplate', compact('pageTitle','client'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error in freTemplate: ' . $e->getMessage(), ['clientID' => $clientID]);

            // Redirect to the clients index page with an error message
            return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                             ->with('error', 'An error occurred while trying to display the FRE template.');
        }

    }



    public function emailServer($clientID = null)
    {
        try {
            // Check if clientID is encrypted and decrypt if necessary
            $id = $clientID;
            if (isEncrypted($clientID)) {
                $id = Crypt::decrypt($clientID);
            }

            // Find the client by ID, handle case if not found
            $client = Client::find($id);

            if (!$client) {
                // Client does not exist, redirect with error message
                return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                                 ->with('error', 'Client not found.');
            }

            // Set the page title, including the client name
            $pageTitle = 'Emailer SMTP Credentials for ' . $client->client_name;

            // Return the view with the client data and page title
            return view('email.emailServer', compact('pageTitle','client'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error in freTemplate: ' . $e->getMessage(), ['clientID' => $clientID]);

            // Redirect to the clients index page with an error message
            return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                             ->with('error', 'An error occurred while trying to display the FRE template.');
        }



    }

    public function leadSummaryNotifications($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land Lead Summary Notifications';
            // Return the view with the client data and page title
            return view('reporting.leadSummaryNotifications', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function smsGateway($clientID = null)
    {
        try
        {
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);

            // Set the page title
            $pageTitle = 'A2AHome Land Lead Notification Template';
            // Return the view with the client data and page title
            return view('sms.smsGateway', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
        }
    }

    public function firstResponseSms($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land First Response SMS';
            // Return the view with the client data and page title
            return view('sms.firstResponseSms', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function smsLeadNotifications($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land First Response SMS';
            // Return the view with the client data and page title
            return view('sms.smsLeadNotifications', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }
    public function smsFreTemplate($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS FRE Template';
            // Return the view with the client data and page title
            return view('sms.smsFreTemplate', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }
    public function smsLeadNotificationTemplate($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS Lead Notification Template';
            // Return the view with the client data and page title
            return view('sms.smsLeadNotificationTemplate', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }
    public function setupMonthlyGoals($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS Lead Notification Template';
            // Return the view with the client data and page title
            return view('goals.setupMonthlyGoals', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function leadCapture($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS Lead Notification Template';
            // Return the view with the client data and page title
            return view('forms.leadCapture', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function leadActions($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS Lead Notification Template';
            // Return the view with the client data and page title
            return view('forms.leadActions', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function blacklisting($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS Lead Notification Template';
            // Return the view with the client data and page title
            return view('forms.blacklisting', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function hideCustInfo($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land SMS Lead Notification Template';
            // Return the view with the client data and page title
            return view('forms.hideCustInfo', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    public function revenueTracking($clientID = null)
    {
        try{
            // Decrypt the client ID
            $id = Crypt::decrypt($clientID);

            // Find the client by ID
            $client = Client::findOrFail($id);


            // Set the page title
            $pageTitle = 'A2AHome Land Revenue Tracking Forms';
            // Return the view with the client data and page title
            return view('revenueTracking.revenueTracking', compact('pageTitle','client'));
            } catch (\Exception $e) {
            // Redirect to the clients index page with an error message
            return redirect()->route(route('projectLeads', ['projectID' => Crypt::encrypt($clientID)]))->with('error', 'An error occurred while trying to display the edit form.');
            }
    }

    private function underConstruction($clientID)
    {
        try {

            $clientID=Crypt::decrypt($clientID);
            $client= Client::find($clientID);

            return view('under-construction', compact('client'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function ExternalCRM($clientID = null)
    {
        try {
            // Check if clientID is encrypted and decrypt if necessary
            $id = $clientID;
            if (isEncrypted($clientID)) {
                $id = Crypt::decrypt($clientID);
            }

            // Find the client by ID, handle case if not found
            $client = Client::find($id);

            if (!$client) {
                // Client does not exist, redirect with error message
                return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                                 ->with('error', 'Client not found.');
            }

            // Set the page title, including the client name
            $pageTitle = 'ExternalCRM Credentials for ' . $client->client_name;

            // Return the view with the client data and page title
            return view('externalcrm.index', compact('pageTitle','client'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error in freTemplate: ' . $e->getMessage(), ['clientID' => $clientID]);

            // Redirect to the clients index page with an error message
            return redirect()->route('projectLeads', ['projectID' => Crypt::encrypt($clientID)])
                             ->with('error', 'An error occurred while trying to display the FRE template.');
        }



    }



}