<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\TaskStoreRequest;
use App\Http\Requests\Api\V1\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends BaseController
{
    /**
     * @return TaskCollection
     * Example url: http://localhost:8876/api/v1/tasks
     * Type of request: GET
     * Getting a list of tasks.
     */
    public function index()
    {
       //return new TaskCollection(Task::with('user')->paginate(5));
        return new TaskCollection(Task::with('user')->get());
    }

    /**
     * @param TaskStoreRequest $request
     * @return TaskResource
     * Example url: http://localhost:8876/api/v1/tasks
     * Type of request: POST
     * Store a newly created task in storage.
     */
    public function store(TaskStoreRequest $request): TaskResource
    {
        $task_new = Task::create($request->validated());
        return new TaskResource($task_new);
    }

    /**
     * @param Task $task
     * @return TaskResource
     * Example url: http://localhost:8876/api/v1/tasks/23    (id=23)
     * Type of request: GET
     * Data of the specified task (id=23).
     */
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    /**
     * @param TaskUpdateRequest $request
     * @param Task $task
     * @return TaskResource|\Illuminate\Http\JsonResponse
     * Example url: http://localhost:8876/api/v1/tasks/31    (id=31)
     * Type of request: PUT
     * Update the specified task (id=31) in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task): TaskResource|\Illuminate\Http\JsonResponse
    {
       return $this->service->updateTask($request, $task);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * Example url: http://localhost:8876/api/v1/tasks/34    (id=34)
     * Type of request: DELETE
     * Remove the specified task (id=34) from storage.
     */
    public function destroy(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        return $this->service->deleteTask($request, $task);
    }
}
