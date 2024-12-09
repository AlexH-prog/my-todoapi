<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\TaskStoreRequest;
use App\Http\Requests\Api\V1\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class TaskTreeController extends BaseController
{

    /**
     * @return array
     * Example url: http://localhost:8876/api/v1/tree-api
     * Type of request: GET
     * Getting a task tree and passing it to the API.
     */
    public function index()
    {
        $data = Task::all()->toArray();
        $data1 = collect($data)->keyBy('id')->toArray();
        return $this->tree_service->getTree($data1);
    }
}
