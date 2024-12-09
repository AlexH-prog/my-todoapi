<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\FilterSortService;
use App\Services\V1\Service;
use App\Services\V1\TreeService;

class BaseController extends Controller
{
    public object $service;
    public object $tree_service;

    public function __construct(Service $service, TreeService $tree_service, FilterSortService $filtersort_service)
    {
        $this->service = $service;
        $this->tree_service = $tree_service;
        $this->filtersort_service = $filtersort_service;

    }
}
