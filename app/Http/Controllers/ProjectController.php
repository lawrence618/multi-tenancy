<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // $projects = Project::all();
            $projects = Project::where('user_id', auth()->id())->get(); 

            return view('projects.index', compact('projects'));

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('projects.create');

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            Project::create($request->validated()
                + ['user_id' => auth()->id()] 
            );

            return redirect()->route('projects.index');

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            // TODO: Add logic to handle errors

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {
            if ($project->user_id !== auth()->id()) { 
                abort(403);
            }

            return view('projects.edit', compact('project'));

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $project->update($request->validated());

            return redirect()->route('projects.index');

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();

            return redirect()->route('projects.index');

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }
}
