<?php

namespace App\Constants;

class PermissionsConstant
{
    const SEE_REPORTS = 'see_reports';
    const EXPORT_EXCEL = 'export_excel';

    const USERS_LIST = 'users_list';
    const USERS_CREATE = 'users_create';
    const USERS_EDIT = 'users_edit';
    const USERS_CHANGE_ROLES = 'users_change_roles';
    const USERS_VIEW = 'users_view';
    const USERS_DELETE = 'users_delete';

    const DSC_LIST = 'dsc_list';
    const DSC_CREATE = 'dsc_create';
    const DSC_EDIT = 'dsc_edit';
    const DSC_DELETE = 'dsc_delete';

    const PHD_LIST = 'phd_list';
    const PHD_CREATE = 'phd_create';
    const PHD_EDIT = 'phd_edit';
    const PHD_DELETE = 'phd_delete';

    const FACULTY_LIST = 'faculty_list';
    const FACULTY_CREATE = 'faculty_create';
    const FACULTY_EDIT = 'faculty_edit';
    const FACULTY_DELETE = 'faculty_delete';

    const DEPARTMENT_LIST = 'department_list';
    const DEPARTMENT_CREATE = 'department_create';
    const DEPARTMENT_EDIT = 'department_edit';
    const DEPARTMENT_DELETE = 'department_delete';

    const SCIENTIFIC_ARTICLE_CITATION_LIST = 'scientific_article_citation_list';
    const SCIENTIFIC_ARTICLE_CITATION_CREATE = 'scientific_article_citation_create';
    const SCIENTIFIC_ARTICLE_CITATION_EDIT = 'scientific_article_citation_edit';
    const SCIENTIFIC_ARTICLE_CITATION_CONFIRM = 'scientific_article_citation_confirm';
    const SCIENTIFIC_ARTICLE_CITATION_DELETE = 'scientific_article_citation_delete';

    const SCIENTIFIC_ARTICLE_LIST = 'scientific_article_list';
    const SCIENTIFIC_ARTICLE_CREATE = 'scientific_article_create';
    const SCIENTIFIC_ARTICLE_EDIT = 'scientific_article_edit';
    const SCIENTIFIC_ARTICLE_CONFIRM = 'scientific_article_confirm';
    const SCIENTIFIC_ARTICLE_DELETE = 'scientific_article_delete';

    const OAK_SCIENTIFIC_ARTICLE_LIST = 'oak_scientific_article_list';
    const OAK_SCIENTIFIC_ARTICLE_CREATE = 'oak_scientific_article_create';
    const OAK_SCIENTIFIC_ARTICLE_EDIT = 'oak_scientific_article_edit';
    const OAK_SCIENTIFIC_ARTICLE_CONFIRM = 'oak_scientific_article_confirm';
    const OAK_SCIENTIFIC_ARTICLE_DELETE = 'oak_scientific_article_delete';

    const GRANT_FUND_ORDER_LIST = 'grant_fund_order_list';
    const GRANT_FUND_ORDER_CREATE = 'grant_fund_order_create';
    const GRANT_FUND_ORDER_EDIT = 'grant_fund_order_edit';
    const GRANT_FUND_ORDER_DELETE = 'grant_fund_order_delete';

    const SCIENTIFIC_RESEARCH_CONDUCT_LIST = 'scientific_research_conduct_list';
    const SCIENTIFIC_RESEARCH_CONDUCT_CREATE = 'scientific_research_conduct_create';
    const SCIENTIFIC_RESEARCH_CONDUCT_EDIT = 'scientific_research_conduct_edit';
    const SCIENTIFIC_RESEARCH_CONDUCT_DELETE = 'scientific_research_conduct_delete';

    const STATE_GRANT_FUND_LIST = 'state_grant_fund_list';
    const STATE_GRANT_FUND_CREATE = 'state_grant_fund_create';
    const STATE_GRANT_FUND_EDIT = 'state_grant_fund_edit';
    const STATE_GRANT_FUND_DELETE = 'state_grant_fund_delete';

    const SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST = 'scientific_research_effectiveness_list';
    const SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE = 'scientific_research_effectiveness_create';
    const SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT = 'scientific_research_effectiveness_edit';
    const SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM = 'scientific_research_effectiveness_confirm';
    const SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE = 'scientific_research_effectiveness_delete';

    const OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST = 'obtained_industrial_sample_patent_list';
    const OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE = 'obtained_industrial_sample_patent_create';
    const OBTAINED_INDUSTRIAL_SAMPLE_PATENT_EDIT = 'obtained_industrial_sample_patent_edit';
    const OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CONFIRM = 'obtained_industrial_sample_patent_confirm';
    const OBTAINED_INDUSTRIAL_SAMPLE_PATENT_DELETE = 'obtained_industrial_sample_patent_delete';

    const COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST = 'copyright_protected_various_material_information_list';
    const COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE = 'copyright_protected_various_material_information_create';
    const COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_EDIT = 'copyright_protected_various_material_information_edit';
    const COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CONFIRM = 'copyright_protected_various_material_information_confirm';
    const COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_DELETE = 'copyright_protected_various_material_information_delete';

    public static function groupedList(): array
    {
        return [
            // All permissions for super admin
            UserRoles::SUPER_ADMIN => [
                self::SEE_REPORTS,
                self::EXPORT_EXCEL,

                self::USERS_LIST,
                self::USERS_CREATE,
                self::USERS_EDIT,
                self::USERS_CHANGE_ROLES,
                self::USERS_DELETE,

                self::FACULTY_LIST,
                self::FACULTY_CREATE,
                self::FACULTY_EDIT,
                self::FACULTY_DELETE,

                self::DEPARTMENT_LIST,
                self::DEPARTMENT_CREATE,
                self::DEPARTMENT_EDIT,
                self::DEPARTMENT_DELETE,

                self::DSC_LIST,
                self::DSC_CREATE,
                self::DSC_EDIT,
                self::DSC_DELETE,

                self::PHD_LIST,
                self::PHD_CREATE,
                self::PHD_EDIT,
                self::PHD_DELETE,

                self::SCIENTIFIC_ARTICLE_CITATION_LIST,
                self::SCIENTIFIC_ARTICLE_CITATION_CREATE,
                self::SCIENTIFIC_ARTICLE_CITATION_EDIT,
                self::SCIENTIFIC_ARTICLE_CITATION_CONFIRM,
                self::SCIENTIFIC_ARTICLE_CITATION_DELETE,

                self::SCIENTIFIC_ARTICLE_LIST,
                self::SCIENTIFIC_ARTICLE_CREATE,
                self::SCIENTIFIC_ARTICLE_EDIT,
                self::SCIENTIFIC_ARTICLE_CONFIRM,
                self::SCIENTIFIC_ARTICLE_DELETE,

                self::OAK_SCIENTIFIC_ARTICLE_LIST,
                self::OAK_SCIENTIFIC_ARTICLE_CREATE,
                self::OAK_SCIENTIFIC_ARTICLE_EDIT,
                self::OAK_SCIENTIFIC_ARTICLE_CONFIRM,
                self::OAK_SCIENTIFIC_ARTICLE_DELETE,

                self::GRANT_FUND_ORDER_LIST,
                self::GRANT_FUND_ORDER_CREATE,
                self::GRANT_FUND_ORDER_EDIT,
                self::GRANT_FUND_ORDER_DELETE,

                self::SCIENTIFIC_RESEARCH_CONDUCT_LIST,
                self::SCIENTIFIC_RESEARCH_CONDUCT_CREATE,
                self::SCIENTIFIC_RESEARCH_CONDUCT_EDIT,
                self::SCIENTIFIC_RESEARCH_CONDUCT_DELETE,

                self::STATE_GRANT_FUND_LIST,
                self::STATE_GRANT_FUND_CREATE,
                self::STATE_GRANT_FUND_DELETE,
                self::STATE_GRANT_FUND_EDIT,

                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE,

                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_EDIT,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CONFIRM,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_DELETE,

                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_EDIT,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CONFIRM,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_DELETE,
            ],

            UserRoles::REKTOR => [
                self::SEE_REPORTS,
            ],
            UserRoles::PROREKTOR => [
                self::SEE_REPORTS,
            ],
            UserRoles::DEKAN => [
                self::SEE_REPORTS,
            ],
            UserRoles::KAFEDRA => [
                self::SEE_REPORTS,

                self::SCIENTIFIC_ARTICLE_CITATION_LIST,
                self::SCIENTIFIC_ARTICLE_CITATION_CREATE,

                self::OAK_SCIENTIFIC_ARTICLE_LIST,
                self::OAK_SCIENTIFIC_ARTICLE_CREATE,

                self::SCIENTIFIC_ARTICLE_LIST,
                self::SCIENTIFIC_ARTICLE_CREATE,

                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST,

                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE,

                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE,
            ],
            UserRoles::TEACHER => [
                self::SEE_REPORTS,

                self::SCIENTIFIC_ARTICLE_CITATION_LIST,
                self::SCIENTIFIC_ARTICLE_CITATION_CREATE,

                self::OAK_SCIENTIFIC_ARTICLE_LIST,
                self::OAK_SCIENTIFIC_ARTICLE_CREATE,

                self::SCIENTIFIC_ARTICLE_LIST,
                self::SCIENTIFIC_ARTICLE_CREATE,

                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST,

                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE,

                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE,
            ],
        ];
    }

    /**
     * @return array
     */
    public static function groupedTranslations(): array
    {
        return [
            self::DSC_LIST => __("Фан номзодлари (DSc)ни рўйҳати (1.3.1-жадвал)"),
            self::DSC_CREATE => __("Фан номзодлари (DSc)ни яратиш (1.3.1-жадвал)"),
            self::DSC_EDIT => __("Фан номзодлари (DSc)ни таҳрирлаш (1.3.1-жадвал)"),
            self::DSC_DELETE => __("Фан номзодлари (DSc)ни ўчириш (1.3.1-жадвал)"),

            self::PHD_LIST => __('Фан номзодлари (Phd)ни рўйҳати (1.3.2-жадвал)'),
            self::PHD_CREATE => __('Фан номзодлари (Phd)ни яратиш (1.3.2-жадвал)'),
            self::PHD_EDIT => __('Фан номзодлари (Phd)ни таҳрирлаш (1.3.2-жадвал)'),
            self::PHD_DELETE => __('Фан номзодлари (Phd)ни ўчириш (1.3.2-жадвал)'),

            self::SCIENTIFIC_ARTICLE_CITATION_LIST => __('Илмий мақолаларга иқтибосларни рўйҳати (1.5-жадвал)'),
            self::SCIENTIFIC_ARTICLE_CITATION_CREATE => __('Илмий мақолаларга иқтибосларни яратиш (1.5-жадвал)'),
            self::SCIENTIFIC_ARTICLE_CITATION_EDIT => __('Илмий мақолаларга иқтибосларни таҳрирлаш (1.5-жадвал)'),
            self::SCIENTIFIC_ARTICLE_CITATION_CONFIRM => __('Илмий мақолаларга иқтибосларни тасдиқлаш (1.5-жадвал)'),
            self::SCIENTIFIC_ARTICLE_CITATION_DELETE => __('Илмий мақолаларга иқтибосларни ўчириш (1.5-жадвал)'),

            self::SCIENTIFIC_ARTICLE_LIST => __('Илмий мақолаларни рўйҳати (1.6.1-жадвал)'),
            self::SCIENTIFIC_ARTICLE_CREATE => __('Илмий мақолаларни яратиш (1.6.1-жадвал)'),
            self::SCIENTIFIC_ARTICLE_EDIT => __('Илмий мақолаларни таҳрирлаш (1.6.1-жадвал)'),
            self::SCIENTIFIC_ARTICLE_CONFIRM => __('Илмий мақолаларни тасдиқлаш (1.6.1-жадвал)'),
            self::SCIENTIFIC_ARTICLE_DELETE => __('Илмий мақолаларни ўчириш (1.6.1-жадвал)'),

            self::OAK_SCIENTIFIC_ARTICLE_LIST => __('Илмий мақолалар (ОАК рўйхатидаги)ни рўйҳати (1.6.2-жадвал)'),
            self::OAK_SCIENTIFIC_ARTICLE_CREATE => __('Илмий мақолалар (ОАК рўйхатидаги)ни яратиш (1.6.2-жадвал)'),
            self::OAK_SCIENTIFIC_ARTICLE_EDIT => __('Илмий мақолалар (ОАК рўйхатидаги)ни таҳрирлаш (1.6.2-жадвал)'),
            self::OAK_SCIENTIFIC_ARTICLE_CONFIRM => __('Илмий мақолалар (ОАК рўйхатидаги)ни тасдиқлаш (1.6.2-жадвал)'),
            self::OAK_SCIENTIFIC_ARTICLE_DELETE => __('Илмий мақолалар (ОАК рўйхатидаги)ни ўчириш (1.6.2-жадвал)'),

            self::GRANT_FUND_ORDER_LIST => __('Грантлар ва илмий фондлар маблағларини рўйҳати (1.7.1-жадвал)'),
            self::GRANT_FUND_ORDER_CREATE => __('Грантлар ва илмий фондлар маблағларини яратиш (1.7.1-жадвал)'),
            self::GRANT_FUND_ORDER_EDIT => __('Грантлар ва илмий фондлар маблағларини таҳрирлаш (1.7.1-жадвал)'),
            self::GRANT_FUND_ORDER_DELETE => __('Грантлар ва илмий фондлар маблағларини ўчириш (1.7.1-жадвал)'),

            self::SCIENTIFIC_RESEARCH_CONDUCT_LIST => __('Илмий тадқиқотлар маблағларини рўйҳати (1.7.2-жадвал)'),
            self::SCIENTIFIC_RESEARCH_CONDUCT_CREATE => __('Илмий тадқиқотлар маблағларини яратиш (1.7.2-жадвал)'),
            self::SCIENTIFIC_RESEARCH_CONDUCT_EDIT => __('Илмий тадқиқотлар маблағларини таҳрирлаш (1.7.2-жадвал)'),
            self::SCIENTIFIC_RESEARCH_CONDUCT_DELETE => __('Илмий тадқиқотлар маблағларини ўчириш (1.7.2-жадвал)'),

            self::STATE_GRANT_FUND_LIST => __('Давлат грантлари асосида ўтказилган тадқиқотлар маблағларни рўйҳати (1.7.3-жадвал)'),
            self::STATE_GRANT_FUND_CREATE => __('Давлат грантлари асосида ўтказилган тадқиқотлар маблағларни яратиш (1.7.3-жадвал)'),
            self::STATE_GRANT_FUND_EDIT => __('Давлат грантлари асосида ўтказилган тадқиқотлар маблағларни таҳрирлаш (1.7.3-жадвал)'),
            self::STATE_GRANT_FUND_DELETE => __('Давлат грантлари асосида ўтказилган тадқиқотлар маблағларни ўчириш (1.7.3-жадвал)'),

            self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST => __('Илмий-тадқиқот ишларининг самарадорлигини рўйҳати (1.9.1-жадвал)'),
            self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE => __('Илмий-тадқиқот ишларининг самарадорлигини яратиш (1.9.1-жадвал)'),
            self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT => __('Илмий-тадқиқот ишларининг самарадорлигини таҳрирлаш (1.9.1-жадвал)'),
            self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM => __('Илмий-тадқиқот ишларининг самарадорлигини тасдиқлаш (1.9.1-жадвал)'),
            self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE => __('Илмий-тадқиқот ишларининг самарадорлигини ўчириш (1.9.1-жадвал)'),

            self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST => __('Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентларни рўйҳати (1.9.2-жадвал)'),
            self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE => __('Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентларни яратиш (1.9.2-жадвал)'),
            self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_EDIT => __('Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентларни таҳрирлаш (1.9.2-жадвал)'),
            self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CONFIRM => __('Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентларни тасдиқлаш (1.9.2-жадвал)'),
            self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_DELETE => __('Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентларни ўчириш (1.9.2-жадвал)'),

            self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST => __('Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материалларни рўйҳати (1.9.3-жадвал)'),
            self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE => __('Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материалларни яратиш (1.9.3-жадвал)'),
            self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_EDIT => __('Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материалларни таҳрирлаш (1.9.3-жадвал)'),
            self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CONFIRM => __('Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материалларни тасдиқлаш (1.9.3-жадвал)'),
            self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_DELETE => __('Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар ўчириш (1.9.3-жадвал)'),

            self::SEE_REPORTS => __('Хисоботларни кўриш'),
            self::EXPORT_EXCEL => __('Excelга юклаб олиш'),

            self::USERS_LIST => __("Фойдаланувчиларни рўйҳати"),
            self::USERS_CREATE => __("Фойдаланувчиларни яратиш"),
            self::USERS_EDIT => __("Фойдаланувчиларни таҳрирлаш"),
            self::USERS_CHANGE_ROLES => __("Фойдаланувчиларни ролини ўзгартириш"),
            self::USERS_VIEW => __("Фойдаланувчиларни кўриш"),
            self::USERS_DELETE => __("Фойдаланувчиларни ўчириш"),

            self::FACULTY_LIST => __('Факультетларни рўйҳати'),
            self::FACULTY_CREATE => __('Факультетларни яратиш'),
            self::FACULTY_EDIT => __('Факультетларни таҳрирлаш'),
            self::FACULTY_DELETE => __('Факультетларни ўчириш'),

            self::DEPARTMENT_LIST => __('Кафедраларни рўйҳати'),
            self::DEPARTMENT_CREATE => __('Кафедраларни яратиш'),
            self::DEPARTMENT_EDIT => __('Кафедраларни таҳрирлаш'),
            self::DEPARTMENT_DELETE => __('Кафедраларни ўчириш'),
        ];
    }

    /**
     * @return \string[][]
     */
    public static function groupedByTypeList(): array
    {
        return [
            'reports' => [
                self::SEE_REPORTS,
                self::EXPORT_EXCEL,

            ],
            'users' => [
                self::USERS_LIST,
                self::USERS_CREATE,
                self::USERS_EDIT,
                self::USERS_CHANGE_ROLES,
                self::USERS_DELETE,
            ],
            'faculties' => [
                self::FACULTY_LIST,
                self::FACULTY_CREATE,
                self::FACULTY_EDIT,
                self::FACULTY_DELETE,
            ],
            'departments' => [
                self::DEPARTMENT_LIST,
                self::DEPARTMENT_CREATE,
                self::DEPARTMENT_EDIT,
                self::DEPARTMENT_DELETE,
            ],
            'dsc' => [
                self::DSC_LIST,
                self::DSC_CREATE,
                self::DSC_EDIT,
                self::DSC_DELETE,
            ],
            'phd' => [
                self::PHD_LIST,
                self::PHD_CREATE,
                self::PHD_EDIT,
                self::PHD_DELETE,
            ],

            'citations' => [
                self::SCIENTIFIC_ARTICLE_CITATION_LIST,
                self::SCIENTIFIC_ARTICLE_CITATION_CREATE,
                self::SCIENTIFIC_ARTICLE_CITATION_EDIT,
                self::SCIENTIFIC_ARTICLE_CITATION_CONFIRM,
                self::SCIENTIFIC_ARTICLE_CITATION_DELETE,
            ],
            'articles' => [
                self::SCIENTIFIC_ARTICLE_LIST,
                self::SCIENTIFIC_ARTICLE_CREATE,
                self::SCIENTIFIC_ARTICLE_EDIT,
                self::SCIENTIFIC_ARTICLE_CONFIRM,
                self::SCIENTIFIC_ARTICLE_DELETE,
            ],
            'oak_articles' => [
                self::OAK_SCIENTIFIC_ARTICLE_LIST,
                self::OAK_SCIENTIFIC_ARTICLE_CREATE,
                self::OAK_SCIENTIFIC_ARTICLE_EDIT,
                self::OAK_SCIENTIFIC_ARTICLE_CONFIRM,
                self::OAK_SCIENTIFIC_ARTICLE_DELETE,
            ],

            'grant_fund_orders' => [
                self::GRANT_FUND_ORDER_LIST,
                self::GRANT_FUND_ORDER_CREATE,
                self::GRANT_FUND_ORDER_EDIT,
                self::GRANT_FUND_ORDER_DELETE,
            ],

            'research_conduct' => [
                self::SCIENTIFIC_RESEARCH_CONDUCT_LIST,
                self::SCIENTIFIC_RESEARCH_CONDUCT_CREATE,
                self::SCIENTIFIC_RESEARCH_CONDUCT_EDIT,
                self::SCIENTIFIC_RESEARCH_CONDUCT_DELETE,
            ],

            'state_grant' => [
                self::STATE_GRANT_FUND_LIST,
                self::STATE_GRANT_FUND_CREATE,
                self::STATE_GRANT_FUND_DELETE,
                self::STATE_GRANT_FUND_EDIT,
            ],

            'research_effectiveness' => [
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM,
                self::SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE,

            ],
            'patent' => [
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_EDIT,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CONFIRM,
                self::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_DELETE,
            ],

            'copyright' => [
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_EDIT,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CONFIRM,
                self::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_DELETE,
            ],
        ];
    }
}
