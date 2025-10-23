<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    /**
     * Retrieve a list of user tasks
     */
    public function index(Request $request)
    {
        return $this->taskService->getUserTasks($request->all());
    }

    public function show($id)
    {
        return $this->taskService->getTaskById($id);
    }

    public function store(TaskRequest $request)
    {
        return $this->taskService->createTask($request->validated());
    }
}
