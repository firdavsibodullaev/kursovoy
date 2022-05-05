<?php

namespace App\View\Composers;

use Illuminate\View\View;

class SidebarVariablesComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $users = ['users.index'];
        $users_create = ['users.create'];

        $phd = ['phd_doctors.index', 'phd_doctors.edit'];
        $phd_create = ['phd_doctors.create'];

        $dsc = ['dsc_doctors.index', 'dsc_doctors.edit'];
        $dsc_create = ['dsc_doctors.create'];

        $article_citation = ['article_citation.index', 'article_citation.edit', 'article_citation.not_confirmed'];
        $article_citation_create = ['article_citation.create'];

        $article = ['scientific_article.index', 'scientific_article.edit', 'scientific_article.not_confirmed'];
        $article_create = ['scientific_article.create'];

        $oak_article = ['oak_scientific_article.index', 'oak_scientific_article.edit', 'oak_scientific_article.not_confirmed'];
        $oak_article_create = ['oak_scientific_article.create'];

        $grant_fund_order = ['grant_fund_order.index', 'grant_fund_order.edit'];
        $grant_fund_order_create = ['grant_fund_order.create'];

        $scientific_research_conduct = ['scientific_research_conduct.index', 'scientific_research_conduct.edit'];
        $scientific_research_conduct_create = ['scientific_research_conduct.create'];

        $view->with('pages', [
            'users' => $users,
            'users_create' => $users_create,
            'users_group' => array_merge($users, $users_create),
            'phd' => $phd,
            'phd_create' => $phd_create,
            'phd_group' => array_merge($phd, $phd_create),
            'dsc' => $dsc,
            'dsc_create' => $dsc_create,
            'dsc_group' => array_merge($dsc, $dsc_create),
            'article_citation' => $article_citation,
            'article_citation_create' => $article_citation_create,
            'article_citation_group' => array_merge($article_citation, $article_citation_create),
            'article' => $article,
            'article_create' => $article_create,
            'article_group' => array_merge($article, $article_create),
            'oak_article' => $oak_article,
            'oak_article_create' => $oak_article_create,
            'oak_article_group' => array_merge($oak_article, $oak_article_create),
            'grant_fund_order' => $grant_fund_order,
            'grant_fund_order_create' => $grant_fund_order_create,
            'grant_fund_order_group' => array_merge($grant_fund_order, $grant_fund_order_create),
            'scientific_research_conduct' => $scientific_research_conduct,
            'scientific_research_conduct_create' => $scientific_research_conduct_create,
            'scientific_research_conduct_group' => array_merge($scientific_research_conduct, $scientific_research_conduct_create)
        ]);
    }
}
