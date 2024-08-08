<?php
namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\SourceGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SourceController extends Controller
{
    public function index()
    {
        try {
            $pageTitle="Sources";
            $sources = Source::with('sourceGroup')
            ->join('source_group', 'source.source_group_id', '=', 'source_group.id')
            ->orderBy('source_group.name')
            ->orderBy('source.name')
            ->get();

            $addlink=route('sources.create');
            return view('sources.index', compact('sources','addlink','pageTitle'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error fetching sources: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch sources.');
        }
    }

    public function create()
    {
        try {
            $sourceGroups = SourceGroup::all();
            $pageTitle="Add a source";
            return view('sources.create', compact('sourceGroups','pageTitle'));
        } catch (\Exception $e) {
            Log::error('Error fetching source groups: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch source groups.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'source_group_id' => 'required|exists:source_group,id',
            'name' => 'required|max:150',
            'shortcode' => 'required|max:10'
        ]);

        try {
            Source::create($request->all());
            return redirect()->route('sources.index')->with('success', 'Source created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating source: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create source.'.$e->getMessage());
        }
    }

    public function edit(Source $source)
    {
        try {
            $sourceGroups = SourceGroup::all();
            $pageTitle="Edit a source";
            return view('sources.edit', compact('source', 'sourceGroups','pageTitle'));
        } catch (\Exception $e) {
            Log::error('Error fetching source or source groups: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch source or source groups.');
        }
    }

    public function update(Request $request, Source $source)
    {
        $request->validate([
            'source_group_id' => 'required|exists:source_group,id',
            'name' => 'required|max:150',
            'shortcode' => 'required|max:10'
        ]);

        try {
            $source->update($request->all());
            return redirect()->route('sources.index')->with('success', 'Source updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating source: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update source.');
        }
    }

    public function destroy(Source $source)
    {
        try {
            $source->delete();
            return redirect()->route('sources.index')->with('success', 'Source deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting source: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete source.');
        }
    }
}
