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

class ClientController extends Controller
{
// Display a listing of the resource.
public function index()
{
    $pageTitle = 'Projects List'; // Set the page title
    $clients = [];
$addlink=route('clients.create');
    try {

        $clients = Client::select('clients.*')
        ->orderBy('clients.active', 'DESC')
        ->orderBy('clients.client_name')
        ->get();
    } catch (\Exception $e) {
        // Log the exception message
        \Log::error('Failed to retrieve clients: ' . $e->getMessage());
        // Optionally, set a user-friendly error message
        return view('clients.index', ['pageTitle' => $pageTitle, 'error' => 'An error occurred while fetching clients.']);
    }

    return view('clients.index', compact('clients', 'pageTitle','addlink'));
}

    // Show the form for creating a new resource.
    public function create()
    {
        return view('clients.create');
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

    // Show the form for editing the specified resource.
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
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

    // Remove the specified resource from storage.
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}