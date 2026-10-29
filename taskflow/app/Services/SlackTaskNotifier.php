<?php

namespace App\Services;
use Illuminate\Http\Client\PendingRequest;
use App\Contracts\TaskNotifier;
use App\Models\Task;

class SlackTaskNotifier implements TaskNotifier
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly PendingRequest $http){}

    public function notifyAssigned(Task $task): void
    {
        $this->http->post(config('services.slack.webhook'), [
            'text' => "Nouvelle tâche : {$task->title}",
        ]);
    }
   
}
