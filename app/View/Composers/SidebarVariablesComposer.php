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
        ]);
    }
}
