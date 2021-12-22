<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DScDoctorResource extends JsonResource
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
            'diploma' => json_decode($this->diploma, true) ?? null,
            'professor_without_science_degree' => json_decode($this->professor_without_science_degree, true) ?? null,
            'speciality_name' => $this->speciality_name,
            'employment' => json_decode($this->employment, true),
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
