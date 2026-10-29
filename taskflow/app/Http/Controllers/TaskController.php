<?php

namespace App\Http\Controllers;

use App\Actions\CompleteTask;
use App\Contracts\TaskNotifier;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{   

    public function __construct(private readonly TaskNotifier $notifier) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tasks = Task::query()
            ->with(['project', 'assignee'])
            ->whereHas('project.members', fn ($q) => $q->whereKey($request->user()->id))
            ->latest()
            ->paginate(20);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('tasks.create', [
            'projects' => $request->user()->projects()->active()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());

        return redirect()->route('tasks.show', $task)->with('success', 'Tâche créée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        // $this->authorize('view', $task);

        return view('tasks.show', ['task' => $task->load('project', 'assignee')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        // $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        // $this->authorize('update', $task);
        $task->update($request->validated());

        return back()->with('success', 'Tâche mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée.');
    }

    public function complete(Task $task, CompleteTask $action): RedirectResponse
    {
        // $this->authorize('update', $task);
        $action->handle($task, request()->user());

        return back()->with('success', 'Tâche terminée.');
    }

    public function assign(Task $task, User $user): RedirectResponse
    {
        // $this->authorize('update', $task);
        $task->update(['assignee_id' => $user->id]);
        $this->notifier->notifyAssigned($task);

        return back();
    }
}
