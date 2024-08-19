<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{


    public function storeOrUpdateSetting(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'client_id' => 'required|integer',
                'type' => 'required|string|max:30',
                'crm_name' => 'required|string',
                'api_url' => 'required|url',
                'auth_method' => 'required|string',
                'api_token' => 'nullable|string',
                'api_key' => 'nullable|string',
                'username' => 'nullable|string',
                'password' => 'nullable|string',
                'is_active' => 'required|boolean',
                'schema_keys.*' => 'nullable|string',   // Allow schema keys
                'schema_values.*' => 'nullable|string', // Allow schema values
            ]);

            // Retrieve schema keys and values from the request
            $schemaKeys = $request->input('schema_keys', []);
            $schemaValues = $request->input('schema_values', []);

            // Retrieve existing setting if it exists
            $setting = Setting::where('client_id', $validatedData['client_id'])
                              ->where('type', $validatedData['type'])
                              ->first();

            // Initialize schemaData with an empty array
            $schemaData = [];

            // Process new schema data
            foreach ($schemaKeys as $index => $key) {
                if (!empty($key)) {
                    $value = isset($schemaValues[$index]) ? $schemaValues[$index] : null;
                    if (!empty($value)) {
                        // Add or update the schema data
                        $schemaData[$key] = $value;
                    }
                }
            }

            // Prepare the final input data for storage
            $inputNamesAndValues = $request->except(['_token', 'value']); // Exclude CSRF token and 'value'
            if (!empty($schemaData)) {
                $inputNamesAndValues['schema'] = $schemaData;
            } else {
                // Remove schema key if no schema data is left
                unset($inputNamesAndValues['schema']);
            }

            // Clean all values to remove newlines and excessive whitespace
            $inputNamesAndValues = array_map(function($value) {
                return is_string($value) ? preg_replace('/\s+/', ' ', trim($value)) : $value;
            }, $inputNamesAndValues);

            // Convert the cleaned input names and values to JSON format
            $jsonValue = json_encode($inputNamesAndValues);

            // Retrieve or create the setting
            Setting::updateOrCreate(
                ['client_id' => $validatedData['client_id'],
                 'type' => $validatedData['type']],
                ['form_data' => $jsonValue]
            );

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Setting saved successfully.');
        } catch (ValidationException $e) {
            // Redirect back with a validation error message
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Redirect back with a general error message
            return redirect()->back()->with('error', 'An error occurred while saving the setting.');
        }
    }








}
