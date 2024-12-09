<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class TaskResource extends JsonResource
{
   // public static $wrap = 'test';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'status' => $this->status,
        //'name' =>  $this->user->name,
        //'user' => $this->user,
        'priority' => intval($this->priority),
        'parentId' => $this->parent_id,
        'userId' => $this->user_id,
        'createdAt' => $this->created_at,
        'completedAt' => $this->completed_at,
        ];
    }
}
