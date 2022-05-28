<?php

namespace App\Http\Controllers;

use App\Http\Resources\Report\ArticlesResource;
use App\Services\OakScientificArticleService;
use App\Services\ReportService;
use App\Services\ScientificArticleCitationService;
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

    /**
     * @return ArticlesResource
     */
    public function scientificArticleCitations(): ArticlesResource
    {
        $articles = app(ScientificArticleCitationService::class)->getReport();
        return new ArticlesResource($articles);
    }

    /**
     * @return ArticlesResource
     */
    public function scientificArticleCitationsByFaculty(): ArticlesResource
    {
        $articles = app(ScientificArticleCitationService::class)->getReportByFaculty();
        return new ArticlesResource($articles);
    }

    /**
     * @return ArticlesResource
     */
    public function oakScientificArticleCitations(): ArticlesResource
    {
        $articles = app(OakScientificArticleService::class)->getReport();
        return new ArticlesResource($articles);
    }

    /**
     * @return ArticlesResource
     */
    public function oakScientificArticleCitationsByFaculty(): ArticlesResource
    {
        $articles = app(OakScientificArticleService::class)->getReportByFaculty();
        return new ArticlesResource($articles);
    }
}
