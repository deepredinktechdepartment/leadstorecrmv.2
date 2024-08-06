<?php

namespace App\Http\Controllers;

use App\Models\SourceGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SourceGroupController extends Controller
{
    public function index()
    {
        try {
            $sourceGroups = SourceGroup::all();
            return view('source_groups.index', compact('sourceGroups'));
        } catch (\Exception $e) {
            Log::error('Error fetching source groups: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch source groups.');
        }
    }

    public function create()
    {
        return view('source_groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'source_icon' => 'nullable|string|max:220',
            'name' => 'required|max:200'
        ]);

        try {
            SourceGroup::create($request->all());
            return redirect()->route('source_groups.index')->with('success', 'Source Group created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating source group: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create source group.');
        }
    }

    public function edit(SourceGroup $sourceGroup)
    {
        return view('source_groups.edit', compact('sourceGroup'));
    }

    public function update(Request $request, SourceGroup $sourceGroup)
    {
        $request->validate([
            'source_icon' => 'nullable|string|max:220',
            'name' => 'required|max:200'
        ]);

        try {
            $sourceGroup->update($request->all());
            return redirect()->route('source_groups.index')->with('success', 'Source Group updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating source group: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update source group.');
        }
    }

    public function destroy(SourceGroup $sourceGroup)
    {
        try {
            $sourceGroup->delete();
            return redirect()->route('source_groups.index')->with('success', 'Source Group deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting source group: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete source group.');
        }
    }
}
