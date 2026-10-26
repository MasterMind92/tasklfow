<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Contracts\TaskNotifier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // notion 10 : injection de dépendances
        $this->app->bind(TaskNotifier::class, SlackTaskNotifier::class);
        $this->app->singleton(ReportBuilder::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // notion 07 : casse le chargement paresseux en développement
        Model::preventLazyLoading(! app()->isProduction());

        // notion 16 : journalise les requêtes lentes
        DB::whenQueryingForLongerThan(500, function ($connection, $event) {
            Log::warning('Requête lente', ['sql' => $event->sql, 'ms' => $event->time]);
        });

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
