<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\GetTasksByStatusesRequest;
use App\Http\Requests\GetTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskController extends Controller
{
    public function index(GetTasksRequest $request)
    {
        return auth()->user()->tasks()
            ->where('status_id', '!=', Status::DELETE)
            ->when(
                $request->status_id,
                fn($query) => $query->where('status_id', $request->status_id)
            )->when(
                $request->category_id,
                fn($query) => $query->where('category_id', $request->category_id)
            )->when(
                $request->search,
                fn($query) => $query->where('name', 'like', "%{$request->search}%")
            )->get();
    }

    public function deletedTasks(GetTasksRequest $request)
    {
        return auth()->user()->tasks()
            ->where('status_id', Status::DELETE)
            ->when(
                $request->has('category_id'),
                fn($query) => $query->where('category_id', $request->category_id)
            )->when(
                $request->has('search'),
                fn($query) => $query->where('name', 'like', "%{$request->search}%")
            )->get();
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        return Task::query()->create($validated);
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return $task;
    }

    public function changeStatus(ChangeStatusRequest $request, Task $task)
    {
        $task->update(['status_id' => $request->status_id]);
        return $task;
    }

    public function getByStatuses(GetTasksByStatusesRequest $request)
    {
        return auth()->user()->tasks()
            ->whereIn('status_id', $request->statuses)
            ->get();
    }
}
