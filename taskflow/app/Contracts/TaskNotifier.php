<?php

namespace App\Contracts;

use App\Models\Task;

interface TaskNotifier
{
   public function notifyAssigned(Task $task): void;
}



