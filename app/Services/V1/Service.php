<?php

namespace App\Services\V1;

use App\Enums\ColumnEnum;
use App\Enums\EscDeskEnum;
use App\Http\Requests\Api\V1\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class Service
{
    /**
     * @param TaskUpdateRequest $request
     * @param $task
     * @return TaskResource|\Illuminate\Http\JsonResponse
     * Example url: http://localhost:8876/api/v1/tasks/39    (id=39)
     * Type of request: PUT
     */
    public function updateTask(TaskUpdateRequest $request, $task): TaskResource|\Illuminate\Http\JsonResponse
    {
        if ($request->user()->can('update', $task)) {

            if (isset($request->status) & ($request->status == 'done')) {

                $tree_service = new TreeService;
                $tasks = $tree_service->getTasks();

                $parents_with_direct_children = $tree_service->ArrayParentsWithDirectChildren($tasks);
                $id_task_for_update = $task->id;

                $branch_of_tree = $tree_service->BranchOfChildTasks($parents_with_direct_children, $id_task_for_update);
                unset($branch_of_tree[0]);

                $tasks_todo = Task::query()->find($branch_of_tree)->where('status', 'todo')->toArray();

                if (!empty($tasks_todo)) {
                    $id_tasks_with_todo = [];
                    foreach ($tasks_todo as $item) {
                        $id_tasks_with_todo[] = $item['id'];
                    }
                    $id_tasks_with_todo = (implode(', ', $id_tasks_with_todo));
                    return response()->json([
                        'title' => 'Forbidden. You can not set the status = done',
                        'detail' => 'Task with id = ' . $task->id . ' have subtasks id = ' . $id_tasks_with_todo . ' with status = todo!'
                    ], 403 );
                }
            }
              $task->update($request->validated());
              return new TaskResource($task);
           // return $task;
        }
        return response()->json([
            'title' => 'Forbidden. You can not update it!',
            'detail' => 'It is not your task id = ' . $task->id . '.'
        ], 403  );
    }

    /**
     * @param $request
     * @param $task
     * @return \Illuminate\Http\JsonResponse
     * Example url: http://localhost:8876/api/v1/tasks/35  (id=35)
     * Type of request: DEL
     */
    public function deleteTask($request, $task): \Illuminate\Http\JsonResponse
    {
        $task_id = $task->id;

        if (Gate::check('delete-task', $task)) {

            if ($task->status == 'todo') {
                $task->delete();
                return response()->json([
                    'title' => 'Ok. Task removed',
                    'detail' => 'Task with id = ' . $task_id . ' removed'
                ], 200);
            }
            return response()->json([
                'title' => 'Forbidden. You can not delete it.',
                'detail' => 'Task id = ' . $task_id . ' has status = done!'
            ], 403);
        }
        return response()->json([
            'title' => 'Forbidden. You can not delete it.',
            'detail' => 'Task with id = ' . $task_id . ' is not your task or you are not authorized!'
        ], 403);
    }
}
