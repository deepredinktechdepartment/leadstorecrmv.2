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
        ]);

        // Get all form inputs except '_token' and 'value'
        $inputNamesAndValues = $request->except(['_token', 'value']); // Exclude CSRF token and 'value'

        // Clean all values to remove newlines and excessive whitespace
        $inputNamesAndValues = array_map(function($value) {
            return is_string($value) ? preg_replace('/\s+/', ' ', trim($value)) : $value;
        }, $inputNamesAndValues);

        // Convert the cleaned input names and values to JSON format
        $jsonValue = json_encode($inputNamesAndValues);

        // Retrieve or create the setting
        $setting = Setting::updateOrCreate(
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
