<?php

namespace App\Services\V1;

use App\Enums\ColumnEnum;
use App\Enums\EscDeskEnum;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

/**
 * This class is used in class FilterSortingController.
 */
class FilterSortService
{
    /**
     * This function is used in class FilterSortingController.
     * Filter data of the tasks by 'status' (status ='done' or 'todo').
     * Example url (e.g. 'status'='done'): http://localhost:8876/api/v1/filter-sorting?status=done
     * Type of request: GET
     *
     * @param $status
     * @return TaskCollection
     */
    public function filterStatus($status): TaskCollection
    {
        //return TaskCollection::collection(Task::where('status', $status)->get());
        return new TaskCollection(Task::where('status', $status)->get());
    }

    /**
     * This function is used in class FilterSortingController.
     * Filter data of the tasks by 'priority' (priority = 1,2,3,4,5).
     * Example url (e.g. 'priority' = 3): http://localhost:8876/api/v1/filter-sorting?priority=3
     * Type of request: GET
     *
     * @param $priority
     * @return TaskCollection
     */
    public function filterPriority($priority): TaskCollection
    {
        return new TaskCollection(Task::where('priority', $priority)->get());
    }

    /**
     * This function is used in class FilterSortingController.
     * Sort the tasks by 'priority', 'created_at', 'completed_at' and provides error information.
     * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[completed_at]=desc&sorting[priority]=asc
     * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[created_at]=asc&sorting[priority]=desc
     * Type of request: GET
     *
     * @param $sorting
     * @return TaskCollection|\Illuminate\Http\JsonResponse
     */
    public function sortingTasks($sorting): TaskCollection|\Illuminate\Http\JsonResponse
    {
        $column = [];
        $direction = [];
        if (isset($sorting)) {
            foreach ($sorting as $name_column => $name_direction) {

                $name_column =  ColumnEnum::tryFrom($name_column)?? 'error';

                if($name_column == 'error'){
                    // Unknown column 'completed_a' in 'order clause
                    return response()->json([
                        'title' => 'Bad name of column in request.',
                        'detail' => 'The column name should be: createdAt, completedAt or priority.'
                    ], 400);
                }
                $name_direction =  EscDeskEnum::tryFrom($name_direction)?? 'error';
                if($name_direction == 'error'){
                    // Order direction must be "asc" or "desc"
                    return response()->json([
                        'title' => 'Bad Name of direction in request.',
                        'detail' => 'Order direction should be asc or desc.'
                    ], 400);
                }
                $column[] = $name_column->name;
                $direction[] = $name_direction->name;
            }
            $tasks = Task::query()
                ->orderBy($column[0], $direction[0])
                ->orderBy($column[1], $direction[1])
                ->get();
        }
        return new TaskCollection($tasks);
    }

    /**
     * This function is used in class FilterSortingController.
     * FilterFullText data of the tasks by 'title' or 'description'.
     * Example url: http://localhost:8876/api/v1/filter-sorting?filter[title]=Word
     * Example url: http://localhost:8876/api/v1/filter-sorting?filter[description]=Word
     * Type of request: GET
     *
     * @param $filter
     * @return TaskCollection|\Illuminate\Http\JsonResponse
     */
    public function filterFullText($filter): TaskCollection|\Illuminate\Http\JsonResponse
    {
        if (isset($filter['title'])) {
             $title = DB::table('tasks')
                ->whereFullText('title', $filter['title'])
                ->get();

            if(collect($title)->isEmpty()) {
                 return response()->json([
                     'title' => 'Not Found',
                      'detail' => 'In title "'.$filter['title'] .'" is not founded. '
                 ], 404);
             }
             return new TaskCollection($title);
        }

        if (isset($filter['description'])) {
            $description = DB::table('tasks')
                ->whereFullText('description', $filter['description'])
                ->get();

            if(collect($description)->isEmpty()) {
                return response()->json([
                    'description' => 'Not Found',
                    'detail' => 'In description "' . $filter['description'] . '" is not founded. '
                ], 404);
            }
            return new TaskCollection($description);
        }
    }

}
