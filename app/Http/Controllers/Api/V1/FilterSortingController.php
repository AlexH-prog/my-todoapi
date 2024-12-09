<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\PriorityStatusEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Http\Request;


class  FilterSortingController extends BaseController
{
    /**
     * @param Request $request
     * @return \App\Http\Resources\TaskCollection|\Illuminate\Http\JsonResponse
     * Filter and sorting different data of the tasks
     */
    public function index(Request $request)
    {
        /**
         * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[completed_at]=desc&sorting[priority]=asc
         * Example url: http://localhost:8876/api/v1/filter-sorting?sorting[created_at]=asc&sorting[priority]=desc
         * Type of request: GET
         * Sorting data of the tasks by 'priority', 'created_at', 'completed_at'
         */
        if ($sorting = $request->query('sorting')) {
            return  $this->filtersort_service->sortingTasks($sorting);
        }

        /**
         * Example url: http://localhost:8876/api/v1/filter-sorting?status=done   (status=done or todo)
         * Type of request: GET
         * Filtering data of the tasks by 'status'.
         */
        if ($status = $request->enum('status', TaskStatusEnum::class)) {
            return $this->filtersort_service->filterStatus($status->value);
        }

        /**
         * Example url: http://localhost:8876/api/v1/filter-sorting?priority=3     (priority = 1,2,3,4,5)
         * Type of request: GET
         * Sorting data of the tasks by 'priority'.
         */
        elseif ($priority = $request->enum('priority', PriorityStatusEnum::class)) {
            return $this->filtersort_service->filterPriority($priority->value);
        }

        /**
         * Example url: http://localhost:8876/api/v1/filter-sorting?filter[title]=Koelpin
         * Example url: http://localhost:8876/api/v1/filter-sorting?filter[description]=World
         * Type of request: GET
         * FilterFullText data of the tasks by 'title' or 'description'.
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
