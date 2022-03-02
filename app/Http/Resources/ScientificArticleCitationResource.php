<?php

namespace App\Http\Resources;

use App\Constants\LanguagesConstant;
use Illuminate\Http\Resources\Json\JsonResource;

class ScientificArticleCitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'magazine' => new MagazineResource($this->whenLoaded('magazine')),
            'magazine_publish_date_formatted' => date('d-m-Y', strtotime($this->magazine_publish_date)),
            'magazine_publish_date' => $this->magazine_publish_date,
            'article_title' => $this->article_title,
            'article_language' => [
                'key' => $this->article_language,
                'value' => LanguagesConstant::translatedList($this->article_language),
            ],
            'link' => $this->link,
            'citations_count' => $this->citations_count,
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
