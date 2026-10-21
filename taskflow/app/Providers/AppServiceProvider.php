<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use App\Models\Task;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Collection::macro('groupedByStatus', function () {
            return $this->groupBy(fn (Task $task) => $task->status->value);
        });

        Response::macro('csv', function (string $filename, array $rows) {
            return response()->streamDownload(function () use ($rows) {
                $out = fopen('php://output', 'w');
                foreach ($rows as $row) { fputcsv($out, $row); }
            }, $filename);
        });
    }
}
