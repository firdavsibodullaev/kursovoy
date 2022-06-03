<?php

namespace App\Http\Resources;

use App\Constants\PermissionsConstant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionsResource extends JsonResource
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
            'name' => PermissionsConstant::groupedTranslations()[$this->name],
            'key' => $this->name
        ];
    }
}
