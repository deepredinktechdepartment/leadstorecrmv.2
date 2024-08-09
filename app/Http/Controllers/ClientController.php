<?php

// app/Http/Controllers/ClientController.php
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
use App\Rules\ImageDimension;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
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
        $query = Client::select('clients.*')
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

        // Find the client by ID
        $client = Client::findOrFail($clientId);

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
            'address1' => 'nullable|string|max:255',
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
            'notes' => 'nullable|string',
            'logo' => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048', new ImageDimension(55)], // Validate image
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

                // Handle file upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/logos', $filename);
        } else {
            $filename = null;
        }


            $client = $id ? Client::findOrFail(Crypt::decrypt($id)) : new Client;

            // Assign values to client properties
            $client->client_name = $request->name;
            $client->short_name = $request->short_name;

            // Set logo path if available
            if ($filename) {
            $client->logo = 'logos/' . $filename;
            }
            $client->industry_category = $request->industry;

            $client->client_address1 = $request->address1;
            $client->client_address2 = $request->address2;
            $client->client_city = $request->city;
            $client->client_state = $request->state;
            $client->zip_code = $request->zip;
            $client->client_webpage = $request->domain;
            $client->client_pan = $request->pan;
            $client->client_tan = $request->tan;

            $client->client_notes = $request->notes;
            $client->save();

            // Redirect with success message
            $message = $id ? 'Client updated successfully!' : 'Client created successfully!';
            return redirect()->route('clients.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error saving client: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while saving the client.');
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

}