<?php

namespace App\Http\Controllers\Api;

use App\Constants\LanguagesConstant;
use App\Http\Controllers\Controller;
use App\Http\Resources\MagazineResource;
use App\Services\ListService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListController extends Controller
{
    /**
     * @var ListService
     */
    private $listService;

    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function magazines(): AnonymousResourceCollection
    {
        return MagazineResource::collection($this->listService->getMagazinesList());
    }

    /**
     * @return array|string
     */
    public function languages()
    {
        return LanguagesConstant::translatedList();
    }
}
