<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;


class TaskTreeController extends BaseController
{

    /**
     * Get the task tree and pass it to the API.
     * Url: http://localhost:8876/api/v1/tree-api
     * Type of request: GET
     *
     * @return array
     */
    public function index()
    {
        $data = Task::all()->toArray();
        $data1 = collect($data)->keyBy('id')->toArray();
        return $this->tree_service->getTree($data1);
    }
}
