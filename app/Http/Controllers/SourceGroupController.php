<?php

namespace App\Http\Controllers;

use App\Models\SourceGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SourceGroupController extends Controller
{
    public function index()
    {
        try {
            $sourceGroups = SourceGroup::all();
            $addlink=route('source_groups.create');
            return view('source_groups.index', compact('sourceGroups','addlink'));
        } catch (\Exception $e) {
            Log::error('Error fetching source groups: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch source groups.');
        }
    }

    public function create()
    {
            try{
            return view('source_groups.create');
            } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create source group.');
            }
    }

    public function store(Request $request)
    {
        $request->validate([
            'source_icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:200',
        ]);

        try {
            $sourceGroup = new SourceGroup();
            $sourceGroup->name = $request->input('name');

            if ($request->hasFile('source_icon')) {
                $file = $request->file('source_icon');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('images', $filename, 'public');
                $sourceGroup->source_icon = $filename;
            }

            $sourceGroup->save();

            return redirect()->route('source_groups.index')->with('success', 'Source Group added successfully.');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'Failed to add Source Group.');
        }
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $sourceGroup = SourceGroup::findOrFail($decryptedId);
            return view('source_groups.edit', compact('sourceGroup'));
        } catch (\Exception $e) {
            // Handle decryption or not found exception
            return redirect()->route('source_groups.index')->with('error', 'Invalid source group ID.');
        }
    }


public function update(Request $request, $id)
{
    $id = Crypt::decrypt($id);
    $sourceGroup = SourceGroup::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'source_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $sourceGroup->name = $request->name;

    if ($request->hasFile('source_icon')) {
        if ($sourceGroup->source_icon && file_exists(public_path('images/' . $sourceGroup->source_icon))) {
            unlink(public_path('images/' . $sourceGroup->source_icon));
        }

        $file = $request->file('source_icon');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $sourceGroup->source_icon = $filename;
    }

    $sourceGroup->save();

    return redirect()->route('source_groups.index')->with('success', 'Source Group updated successfully.');
}

public function destroy($id)
{


        try {
            $id = Crypt::decrypt($id);
            $sourceGroup = SourceGroup::findOrFail($id);
            $sourceGroup->delete();
            return redirect()->route('source_groups.index')->with('success', 'Source Group deleted successfully.');
        } catch (QueryException $e) {
            Log::error('Error deleting source group: ' . $e->getMessage());

            $errorMessage = 'An error occurred while deleting the source group.';

            switch ($e->getCode()) {
                case '23000': // Integrity constraint violation
                case '23503': // Foreign key violation
                    $errorMessage = 'Failed to delete source group. This source group is associated with existing sources and cannot be deleted.';
                    break;
                case '40001': // Serialization failure
                    $errorMessage = 'Failed to delete source group due to a deadlock. Please try again.';
                    break;
                case '42S22': // Column not found
                case '42000': // Syntax error or access violation
                    $errorMessage = 'Failed to delete source group due to a database error. Please contact support.';
                    break;
                default:
                    $errorMessage = 'An unexpected error occurred. Please contact support.';
                    break;
            }

            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
