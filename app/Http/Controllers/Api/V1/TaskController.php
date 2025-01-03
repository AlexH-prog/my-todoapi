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
     * Get a list of all tasks.
     * Example url: http://localhost:8876/api/v1/tasks
     * Type of request: GET
     *
     * @return TaskCollection
     */
    public function index()
    {
        return new TaskCollection(Task::with('user')->paginate(5));
        //return new TaskCollection(Task::with('user')->get());
    }

    /**
     * Store a newly created task in storage.
     * Example url: http://localhost:8876/api/v1/tasks
     * Type of request: POST
     *
     * @param TaskStoreRequest $request
     * @return TaskResource
     */
    public function store(TaskStoreRequest $request): TaskResource
    {
        $task_new = Task::create($request->validated());
        return new TaskResource($task_new);
    }

    /**
     * Get data of the specified task.
     * Example url (e.g.task with id=23): http://localhost:8876/api/v1/tasks/23
     * Type of request: GET
     *
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified task in storage.
     * Example url (e.g. task with id=31): http://localhost:8876/api/v1/tasks/31
     * Type of request: PATCH
     *
     * @param TaskUpdateRequest $request
     * @param Task $task
     * @return TaskResource|\Illuminate\Http\JsonResponse
     */
    public function update(TaskUpdateRequest $request, Task $task): TaskResource|\Illuminate\Http\JsonResponse
    {
       return $this->service->updateTask($request, $task);
    }

    /**
     * Remove the specified task from storage.
     * Example url (e.g. task with id=34): http://localhost:8876/api/v1/tasks/34
     * Type of request: DELETE
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        return $this->service->deleteTask($request, $task);
    }
}
