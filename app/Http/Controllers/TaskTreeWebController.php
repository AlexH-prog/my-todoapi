<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\V1\TreeService;
use Illuminate\Http\Request;

/**
 * Simplified view of the task tree in a web browser.
 */
class TaskTreeWebController
{
    /**
     * Simplified view of the task tree in a web browser.
     * Example url: http://localhost:8876/tree-web
     * Type of request: GET
     *
     * @return void
     */
    public static function index()
    {
        $data = Task::all()->toArray();
        $data1 = collect($data)->keyBy('id')->toArray();
        $tree = TaskTreeWebController::getTreeTasks($data1);
        TaskTreeWebController::createViewTreeTasks($tree);
    }

    /**
     * Forming the task tree array recursively.
     *
     * @param $data
     * @return array
     */
    public static function getTreeTasks($data)
    {
        $tree = [];
        foreach ($data as $id => & $node) {
            if (!$node['parent_id']) {
                $tree[$id] =& $node;
            } else {
                $data[$node['parent_id']]['children'][$id] =& $node;
            }
        }
        return $tree;
    }

    /**
     * Rendering a simple tasks tree in a web browser.
     * For simplicity, I don't use the "views" folders.
     */
    public static function createViewTreeTasks($tree)
    {
        echo '<ul>';
        foreach ($tree as $item) {
            $bbb = ($item['parent_id'] == 0)? 'Main Task': 'Subtask';
            if (isset($item['children'])) {
                echo  "<li><b>{$bbb}</b>
                       <br><b>id = {$item['id']}</b>
                       <br>title = {$item['title']}
                       <br>status = {$item['status']}
                       <br>priority = {$item['priority']}
                       <br>parent_id = {$item['parent_id']}
                       <br>user_id = {$item['user_id']}";
                echo  TaskTreeWebController::createViewTreeTasks($item['children']);
                echo  '</li>';
            } else {
                echo  "<li><b>{$bbb}</b>
                       <br><b>id = {$item['id']}</b>
                       <br>title = {$item['title']}
                       <br>status = {$item['status']}
                       <br>priority = {$item['priority']}
                       <br>parent_id = {$item['parent_id']}
                       <br>user_id = {$item['user_id']}";
            }
        }
        echo '</ul><br>';
    }
}
