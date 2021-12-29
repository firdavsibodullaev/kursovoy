<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhdDoctorResource extends JsonResource
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
            'user' => $this->user,
            'diploma' => $this->diploma,
            'professor_without_science_degree' => $this->professor_without_science_degree,
            'speciality_name' => $this->speciality_name,
            'employment' => $this->employment
        ];
    }
}
