<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository
{
    public function __construct(
        protected Task $task
    ) {}

    public function filter(array $request = [])
    {
        return $this->task->query()
            ->when(isset($request['status']), function ($query) use ($request) {
                $query->where('status', $request['status']);
            })
            ->when(isset($request['priority']), function ($query) use ($request) {
                $query->where('priority', $request['priority']);
            });
    }

    public function filterPaginate(array $request = [])
    {
        return $this->filter($request)
            ->paginate($request['per_page'] ?? 15);
    }
}
