<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacultyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => [
                'uz' => $this->getTranslation('full_name', 'uz'),
                'oz' => $this->getTranslation('full_name', 'oz'),
                'ru' => $this->getTranslation('full_name', 'ru'),
                'en' => $this->getTranslation('full_name', 'en'),
            ],
            'short_name' => [
                'uz' => $this->getTranslation('short_name', 'uz'),
                'oz' => $this->getTranslation('short_name', 'oz'),
                'ru' => $this->getTranslation('short_name', 'ru'),
                'en' => $this->getTranslation('short_name', 'en'),
            ],
            'departments' => DepartmentResource::collection($this->whenLoaded('departments'))
        ];
    }
}
