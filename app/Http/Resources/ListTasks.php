<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListTasks extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'board_id' => $this->board_id,
            'tasks' => Task::collection($this->tasks),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
