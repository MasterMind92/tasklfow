<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{

    public function creating(Task $task): void
    {
        $task->uuid ??= (string) Str::uuid();
    }

    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        if ($task->wasChanged('status')) {
            Cache::forget("project:{$task->project_id}:stats");
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
