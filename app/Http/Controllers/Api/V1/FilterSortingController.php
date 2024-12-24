<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\PriorityStatusEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Http\Request;


class  FilterSortingController extends BaseController
{
    /**
     * Filter and sort the various data tasks.
     *
     * @param Request $request
     * @return \App\Http\Resources\TaskCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        /**
         * Sort the tasks by 'priority', 'created_at', 'completed_at'
         *
         * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[completed_at]=desc&sorting[priority]=asc
         * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[created_at]=asc&sorting[priority]=desc
         * Type of request: GET
         */
        if ($sorting = $request->query('sorting')) {
            return  $this->filtersort_service->sortingTasks($sorting);
        }

        /**
         * Filter data of the tasks by 'status' (status=done or todo).
         *
         * Example url (e.g. status=done): http://localhost:8876/api/v1/filter-sorting?status=done
         * Type of request: GET
         */
        if ($status = $request->enum('status', TaskStatusEnum::class)) {
            return $this->filtersort_service->filterStatus($status->value);
        }

        /**
         * Filter data of the tasks by 'priority' (priority = 1,2,3,4,5).
         *
         * Example url (e.g. 'priority' = 3): http://localhost:8876/api/v1/filter-sorting?priority=3
         * Type of request: GET
         */
        elseif ($priority = $request->enum('priority', PriorityStatusEnum::class)) {
            return $this->filtersort_service->filterPriority($priority->value);
        }

        /**
         * FilterFullText data of the tasks by 'title' or 'description'.
         *
         * Example url: http://localhost:8876/api/v1/filter-sorting?filter[title]=Word
         * Example url: http://localhost:8876/api/v1/filter-sorting?filter[description]=Word
         * Type of request:GET
         */
        if ($filter = $request->query('filter')) {
            return $this->filtersort_service->filterFullText($filter);
        }

        //********************** Error - Bad Request *********************************
        else{
            return response()->json([
                'title' => 'Bad Request.',
                'detail' => 'You should use right url for request.'
            ], 400);
        }
    }

}
