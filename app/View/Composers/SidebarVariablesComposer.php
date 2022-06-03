<?php

namespace App\View\Composers;

use App\Constants\PermissionsConstant;
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

        $state_grant_fund = ['state_grant_fund.index', 'state_grant_fund.edit'];
        $state_grant_fund_create = ['state_grant_fund.create'];

        $scientific_research_effectiveness = ['scientific_research_effectiveness.index', 'scientific_research_effectiveness.edit'];
        $scientific_research_effectiveness_create = ['scientific_research_effectiveness.create'];

        $obtained_industrial_sample_patent = ['obtained_industrial_sample_patent.index', 'obtained_industrial_sample_patent.edit'];
        $obtained_industrial_sample_patent_create = ['obtained_industrial_sample_patent.create'];

        $copyright_protected_various_material_information = ['copyright_protected_various_material_information.index', 'copyright_protected_various_material_information.edit'];
        $copyright_protected_various_material_information_create = ['copyright_protected_various_material_information.create'];

        $department = ['department.index', 'department.edit'];
        $department_create = ['department.create',];

        $faculty = ['faculty.index', 'faculty.edit'];
        $faculty_create = ['faculty.create',];

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
            'scientific_research_conduct_group' => array_merge($scientific_research_conduct, $scientific_research_conduct_create),
            'state_grant_fund' => $state_grant_fund,
            'state_grant_fund_create' => $state_grant_fund_create,
            'state_grant_fund_group' => array_merge($state_grant_fund, $state_grant_fund_create),
            'scientific_research_effectiveness' => $scientific_research_effectiveness,
            'scientific_research_effectiveness_create' => $scientific_research_effectiveness_create,
            'scientific_research_effectiveness_group' => array_merge($scientific_research_effectiveness, $scientific_research_effectiveness_create),
            'obtained_industrial_sample_patent' => $obtained_industrial_sample_patent,
            'obtained_industrial_sample_patent_create' => $obtained_industrial_sample_patent_create,
            'obtained_industrial_sample_patent_group' => array_merge($obtained_industrial_sample_patent, $obtained_industrial_sample_patent_create),
            'copyright_protected_various_material_information' => $copyright_protected_various_material_information,
            'copyright_protected_various_material_information_create' => $copyright_protected_various_material_information_create,
            'copyright_protected_various_material_information_group' => array_merge($copyright_protected_various_material_information, $copyright_protected_various_material_information_create),
            'faculty' => $faculty,
            'faculty_create' => $faculty_create,
            'faculty_group' => array_merge($faculty, $faculty_create),
            'department' => $department,
            'department_create' => $department_create,
            'department_group' => array_merge($department, $department_create),
        ]);
        $view->with('s_permissions', [
            'citations_list' => PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_LIST,
            'citations_create' => PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_CREATE,
            'citations' => [
                PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_LIST,
                PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_CREATE
            ],
            'articles_list' => PermissionsConstant::SCIENTIFIC_ARTICLE_LIST,
            'articles_create' => PermissionsConstant::SCIENTIFIC_ARTICLE_CREATE,
            'articles' => [
                PermissionsConstant::SCIENTIFIC_ARTICLE_LIST,
                PermissionsConstant::SCIENTIFIC_ARTICLE_CREATE
            ],
            'oak_articles_list' => PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_LIST,
            'oak_articles_create' => PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_CREATE,
            'oak_articles' => [
                PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_LIST,
                PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_CREATE
            ],
            'grant_fund_order_list' => PermissionsConstant::GRANT_FUND_ORDER_LIST,
            'grant_fund_order_create' => PermissionsConstant::GRANT_FUND_ORDER_CREATE,
            'grant_fund_order' => [
                PermissionsConstant::GRANT_FUND_ORDER_LIST,
                PermissionsConstant::GRANT_FUND_ORDER_CREATE
            ],
            'research_conduct_list' => PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_LIST,
            'research_conduct_create' => PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_CREATE,
            'research_conduct' => [
                PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_LIST,
                PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_CREATE
            ],
            'state_grant_fund_list' => PermissionsConstant::STATE_GRANT_FUND_LIST,
            'state_grant_fund_create' => PermissionsConstant::STATE_GRANT_FUND_CREATE,
            'state_grant_fund' => [
                PermissionsConstant::STATE_GRANT_FUND_LIST,
                PermissionsConstant::STATE_GRANT_FUND_CREATE
            ],
            'research_effectiveness_list' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST,
            'research_effectiveness_create' => PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE,
            'research_effectiveness' => [
                PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST,
                PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE
            ],
            'patent_list' => PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST,
            'patent_create' => PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE,
            'patent' => [
                PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST,
                PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE
            ],
            'copyright_list' => PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST,
            'copyright_create' => PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE,
            'copyright' => [
                PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST,
                PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE
            ],
            'phd_list' => PermissionsConstant::PHD_LIST,
            'phd_create' => PermissionsConstant::PHD_CREATE,
            'phd' => [
                PermissionsConstant::PHD_LIST,
                PermissionsConstant::PHD_CREATE
            ],
            'dsc_list' => PermissionsConstant::DSC_LIST,
            'dsc_create' => PermissionsConstant::DSC_CREATE,
            'dsc' => [
                PermissionsConstant::DSC_LIST,
                PermissionsConstant::DSC_CREATE
            ],
            'users_list' => PermissionsConstant::USERS_LIST,
            'users_create' => PermissionsConstant::USERS_CREATE,
            'users' => [
                PermissionsConstant::USERS_LIST,
                PermissionsConstant::USERS_CREATE
            ],
            'faculty_list' => PermissionsConstant::FACULTY_LIST,
            'faculty_create' => PermissionsConstant::FACULTY_CREATE,
            'faculty' => [
                PermissionsConstant::FACULTY_LIST,
                PermissionsConstant::FACULTY_CREATE
            ],
            'department_list' => PermissionsConstant::DEPARTMENT_LIST,
            'department_create' => PermissionsConstant::DEPARTMENT_CREATE,
            'department' => [
                PermissionsConstant::DEPARTMENT_LIST,
                PermissionsConstant::DEPARTMENT_CREATE
            ]
        ]);
    }
}
