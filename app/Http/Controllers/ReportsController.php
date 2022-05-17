<?php

namespace App\Http\Controllers;

use App\Http\Resources\Report\ArticlesResource;
use App\Services\ScientificArticleService;

class ReportsController extends Controller
{

    /**
     * @return ArticlesResource
     */
    public function scientificArticles(): ArticlesResource
    {
        $articles = app(ScientificArticleService::class)->getReport();
        return new ArticlesResource($articles);
    }

    /**
     * @return ArticlesResource
     */
    public function scientificArticlesByFaculty(): ArticlesResource
    {
        $articles = app(ScientificArticleService::class)->getReportByFaculty();
        return new ArticlesResource($articles);
    }
}
