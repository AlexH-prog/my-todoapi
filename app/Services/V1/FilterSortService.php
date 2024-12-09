<?php

namespace App\Services\V1;

use App\Enums\ColumnEnum;
use App\Enums\EscDeskEnum;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class FilterSortService
{
    /**
     * @param $status
     * @return TaskCollection
     * Example url: http://localhost:8876/api/v1/filter-sorting?status=done   (status=done or todo)
     * Type of request: GET
     */
    public function filterStatus($status): TaskCollection
    {
        //return TaskCollection::collection(Task::where('status', $status)->get());
        return new TaskCollection(Task::where('status', $status)->get());
    }

    /**
     * @param $priority
     * @return TaskCollection
     * Example url: http://localhost:8876/api/v1/filter-sorting?priority=1     (priority = 1,2,3,4,5)
     * Type of request: GET
     */
    public function filterPriority($priority): TaskCollection
    {
        return new TaskCollection(Task::where('priority', $priority)->get());
    }

    /**
     * @param $sorting
     * @return TaskCollection|\Illuminate\Http\JsonResponse
     * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[completed_at]=desc&sorting[priority]=asc
     * Type of request: GET
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
     * @param $filter
     * @return TaskCollection|\Illuminate\Http\JsonResponse
     * Example1 url: http://localhost:8876/api/v1/filter-sorting?filter[title]=Koelpin
     * Example2 url: http://localhost:8876/api/v1/filter-sorting?filter[description]=Text
     * Type of request: GET
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
