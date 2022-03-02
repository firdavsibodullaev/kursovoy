<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'full_name' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'patronymic' => $this->patronymic,
            ],
            'full_name_string' => "{$this->last_name} {$this->first_name} {$this->patronymic}",
            'username' => $this->username,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'post' => new PostResource($this->post_name),
            'email' => $this->email,
            'faculty' => new FacultyResource($this->whenLoaded('faculty')),
            'department' => new DepartmentResource($this->whenLoaded('department')),
        ];
    }
}
