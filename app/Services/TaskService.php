<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskService
{
    public function __construct(
        protected TaskRepository $taskRepository,
        protected Task $task
    ) {}

    /**
     * Get all tasks
     * @return JsonResource
     * @throws \ErrorException
     */
    public function getUserTasks(array $request = []): JsonResource
    {
        try {
            return TaskResource::collection($this->taskRepository->filterPaginate($request));
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    /**
     * Get task by ID
     * @return TaskResource
     * @throws \ErrorException
     */
    public function getTaskById(int $id): TaskResource
    {
        try {
            $task = $this->task->find($id);
            return new TaskResource($task);
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }

    /**
     * Create a new task
     * @return TaskResource
     * @throws \ErrorException
     */
    public function createTask(array $data): TaskResource
    {
        try {
            $task = $this->task->create([
                ...$data,
                'user_id' => auth()->id(),
            ]);
            return new TaskResource($task);
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }
}
