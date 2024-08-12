<?php
namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
    public function export(Request $request)
    {
        // Validate the request if necessary
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'utm_source' => 'nullable|string',
            'utm_medium' => 'nullable|string',
            'utm_campaign' => 'nullable|string',
        ]);

        // Pass the request parameters to the export class
        return Excel::download(new LeadsExport($request->all()), 'leads.xlsx');
    }
}
