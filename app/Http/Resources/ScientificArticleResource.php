<?php

namespace App\Http\Resources;

use App\Constants\MediaCollectionsConstant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScientificArticleResource extends JsonResource
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
            'title' => $this->title,
            'publish_year' => $this->publish_year,
            'pages' => $this->pages,
            'link' => $this->link,
            'magazine' => new MagazineResource($this->whenLoaded('magazine')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'file' => $this->getFirstMediaUrl(MediaCollectionsConstant::SCIENTIFIC_ARTICLE_FILE) ?: null
        ];
    }
}
