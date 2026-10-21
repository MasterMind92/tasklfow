<?php

namespace App\Models;

use App\Enums\TaskStatus;
use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(TaskObserver::class)]

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    // use HasUuids;

    protected $fillable = [
        'project_id', 'assignee_id', 'title', 'description',
        'status', 'due_at', 'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'due_at'       => 'immutable_datetime',
            'completed_at' => 'immutable_datetime',
            'status'       => TaskStatus::class,
        ];
    }

    // public function uniqueIds(){

    //     return ['uuids'];
    // }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function scopeOverdue(Builder $query): void
    {
        $query->whereNot('status', TaskStatus::Done)
              ->whereNotNull('due_at')
              ->where('due_at', '<', now());
    }

    protected function isLate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status !== TaskStatus::Done && $this->due_at?->isPast(),
        );
    }

}
