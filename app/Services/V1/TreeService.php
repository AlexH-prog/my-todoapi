<?php

namespace App\Services\V1;

use App\Models\Task;

class TreeService
{
    /**
     * @return array
     * Getting data all the tasks
     */
    public function getTasks(): array
    {
        $data = Task::all()->toArray();
        return collect($data)->keyBy('id')->toArray();
    }

    /**
     * @param $data
     * @return array
     * Creating a tree of all tasks.
     */
    public function getTree($data): array
    {
        /**
         * Separating parent and child task nodes from array data all the tasks.
         */
        $parents = [];
        $children = [];
        foreach ($data as $task) {
            if ($task['parent_id'] == 0) {
                $parents[$task['id']] = $task;
            } else {
                $children[$task['id']] = $task;
            }
        }

        /**
         * Creating Multidimensional Array Tree - Organize child under their respective parent
         */
        foreach ($parents as &$parent) {
            $parent['children'] = TreeService::organizeChildren($parent['id'], $children);
        }
        return $parents;
    }

    /**
     * @param $parent
     * @param $children
     * @return array
     * Function used when creating a tree of tasks
     */
    public function organizeChildren($parent, &$children): array
    {
        $result = [];
        foreach ($children as $child) {
            if ($child['parent_id'] == $parent) {
                $child['children'] = TreeService::organizeChildren($child['id'], $children);
                $result[] = $child;
            }
        }
        return $result;
    }

    /**
     * @param $data
     * @return array
     * Creating two-dimensional array of each parents with their direct children
     */
    public function ArrayParentsWithDirectChildren($data): array
    {
        $parents = [];
        //for ($i = 0; $i < count($data); $i++) {
        for ($i = 0; $size = count($data), $i < $size; $i++) {
            foreach ($data as $id => $item) {
                if (empty($parents[$item['parent_id']])) {
                    $parents[$item['parent_id']] = array();
                }
                $parents[$item['parent_id']][$item['id']] = $item;
            }
        }
        return $parents;
    }

    /**
     * @param $data_all_parents_nodes
     * @param $id_parent
     * @return array
     * Creating a flat array by 'id_parent' of subtasks for any parent task.
     */

    function BranchOfChildTasks($data_all_parents_nodes, $id_parent): array
    {
        $array_tasks[] = $id_parent;

        //for ($i = 0; $i < count($array_tasks); $i++) {
        for ($i = 0; $size = count($array_tasks), $i < $size; $i++) {

            if (!empty($data_all_parents_nodes[$array_tasks[$i]])) {
                $array_nodes_tasks = $data_all_parents_nodes[$array_tasks[$i]];
                foreach ($array_nodes_tasks as $id => $node) {
                    $array_tasks[] = $id;
                }
            }
        }
        return $array_tasks;
    }

    /**
     * @param $data_all_parents_nodes
     * @param $array_parent_id_0
     * @return array
     * Creating flat array 'id' of all subtasks for each main tasks with $parent_id = 0
     */
    public function creatArrayFromTreeForDell($data_all_parents_nodes, $array_parent_id_0): array
    {
        //$array_tasks_nodes = [];
        $all_id = [];
        $array_tasks = [];
        foreach ($array_parent_id_0 as $parent_id_0) {
            $array_tasks[] = $parent_id_0['id'];

            for ($i = 0; $size = count($array_tasks), $i < $size; $i++) {

                if (!empty($data_all_parents_nodes[$array_tasks[$i]])) {
                    $array_tasks_nodes = $data_all_parents_nodes[$array_tasks[$i]];

                    foreach ($array_tasks_nodes as $id => $node) {
                        $array_tasks[] = $id;
                    }
                }
            }
            $all_id[] = $array_tasks;
            $array_tasks = [];
        }
        $all_id = collect($all_id)->keyBy(0)->toArray();
        return $all_id;
    }

}
