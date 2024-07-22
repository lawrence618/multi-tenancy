<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::with('project')->get();

            return view('tasks.index', compact('tasks'));

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
            $projects = Project::all();

            return view('tasks.create', compact('projects'));

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
    public function store(StoreTaskRequest $request)
    {
        try {
            Task::create($request->validated());

            return redirect()->route('tasks.index');

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
    public function show(Task $task)
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
    public function edit(Task $task)
    {
        try {
            $projects = Project::all();

            return view('tasks.edit', compact('task', 'projects'));

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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $task->update($request->validated());

            return redirect()->route('tasks.index');

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
    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return redirect()->route('tasks.index');

        } catch (QueryException $e) {
            Log::error('Database error: '.$e->getMessage());
            return view('error')->with('message', 'Database error occurred.');
        } catch (\Exception $e) {
            Log::error('Error: '.$e->getMessage());
            return view('error')->with('message', 'An unexpected error occurred.');
        }
    }
}
