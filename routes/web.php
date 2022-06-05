<?php

use App\Constants\PermissionsConstant;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExcelExportController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\Web\CopyrightProtectedVariousMaterialInformationController;
use App\Http\Controllers\Web\DepartmentController;
use App\Http\Controllers\Web\DscDoctorController;
use App\Http\Controllers\Web\FacultyController;
use App\Http\Controllers\Web\GrantFundOrderController;
use App\Http\Controllers\Web\OakScientificArticleController;
use App\Http\Controllers\Web\ObtainedIndustrialSamplePatentController;
use App\Http\Controllers\Web\PhdDoctorController;
use App\Http\Controllers\Web\ScientificArticleCitationController;
use App\Http\Controllers\Web\ScientificArticleController;
use App\Http\Controllers\Web\ScientificResearchConductController;
use App\Http\Controllers\Web\ScientificResearchEffectivenessController;
use App\Http\Controllers\Web\StateGrantFundController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::view('/', 'index')->name('index');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UserController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::USERS_LIST)
            ->name('index');
        Route::get('search', [UserController::class, 'search'])
            ->middleware('can:' . PermissionsConstant::USERS_LIST)
            ->name('search');
        Route::get('create', [UserController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::USERS_CREATE)
            ->name('create');
        Route::post('', [UserController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::USERS_CREATE)
            ->name('store');
        Route::get('edit/{user:username}', [UserController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::USERS_EDIT)
            ->whereAlphaNumeric('user')
            ->name('edit');
        Route::put('{user:username}', [UserController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::USERS_EDIT)
            ->whereAlphaNumeric('user')
            ->name('update');
        Route::delete('{user:username}', [UserController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::USERS_DELETE)
            ->where('user', '[a-zA-Z0-9\.]+')
            ->name('delete');
        Route::get('role/{user:username}', [UserController::class, 'roles'])
            ->middleware('can:' . PermissionsConstant::USERS_CHANGE_ROLES)
            ->whereAlphaNumeric('user')
            ->name('roles');
        Route::post('role/{user:username}', [UserController::class, 'saveRole'])
            ->middleware('can:' . PermissionsConstant::USERS_CHANGE_ROLES)
            ->whereAlphaNumeric('user')
            ->name('save_role');
    });
    Route::prefix('phd-doctors')->name('phd_doctors.')->group(function () {
        Route::get('', [PhdDoctorController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::PHD_LIST)
            ->name('index');
        Route::get('create', [PhdDoctorController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::PHD_CREATE)
            ->name('create');
        Route::post('', [PhdDoctorController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::PHD_CREATE)
            ->name('store');
        Route::get('edit/{phdDoctor}', [PhdDoctorController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::PHD_EDIT)
            ->whereNumber('phdDoctor')
            ->name('edit');
        Route::put('{phdDoctor}', [PhdDoctorController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::PHD_EDIT)
            ->whereNumber('phdDoctor')
            ->name('update');
        Route::delete('{phdDoctor}', [PhdDoctorController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::PHD_DELETE)
            ->whereNumber('phdDoctor')
            ->name('delete');
    });
    Route::prefix('dsc-doctors')->name('dsc_doctors.')->group(function () {
        Route::get('', [DscDoctorController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::DSC_LIST)
            ->name('index');
        Route::get('create', [DscDoctorController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::DSC_CREATE)
            ->name('create');
        Route::post('', [DscDoctorController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::DSC_CREATE)
            ->name('store');
        Route::get('edit/{dScDoctor}', [DscDoctorController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::DSC_EDIT)
            ->whereNumber('dScDoctor')
            ->name('edit');
        Route::put('{dScDoctor}', [DscDoctorController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::DSC_EDIT)
            ->whereNumber('dScDoctor')
            ->name('update');
        Route::delete('{dScDoctor}', [DscDoctorController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::DSC_DELETE)
            ->whereNumber('dScDoctor')
            ->name('delete');
    });
    Route::prefix('grant-fund-order')->name('grant_fund_order.')->group(function () {
        Route::get('', [GrantFundOrderController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::GRANT_FUND_ORDER_LIST)
            ->name('index');
        Route::get('create', [GrantFundOrderController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::GRANT_FUND_ORDER_CREATE)
            ->name('create');
        Route::get('{grantFundOrder}', [GrantFundOrderController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::GRANT_FUND_ORDER_EDIT)
            ->whereNumber('grantFundOrder')
            ->name('edit');
        Route::post('', [GrantFundOrderController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::GRANT_FUND_ORDER_CREATE)
            ->name('store');
        Route::put('{grantFundOrder}', [GrantFundOrderController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::GRANT_FUND_ORDER_EDIT)
            ->whereNumber('grantFundOrder')
            ->name('update');
        Route::delete('{grantFundOrder}', [GrantFundOrderController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::GRANT_FUND_ORDER_DELETE)
            ->whereNumber('grantFundOrder')
            ->name('delete');
    });
    Route::prefix('scientific-research-conduct')->name('scientific_research_conduct.')->group(function () {
        Route::get('', [ScientificResearchConductController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_LIST)
            ->name('index');
        Route::get('create', [ScientificResearchConductController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_CREATE)
            ->name('create');
        Route::get('{scientificResearchConduct}', [ScientificResearchConductController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_EDIT)
            ->whereNumber('scientificResearchConduct')
            ->name('edit');
        Route::post('', [ScientificResearchConductController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_CREATE)
            ->name('store');
        Route::put('{scientificResearchConduct}', [ScientificResearchConductController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_EDIT)
            ->whereNumber('scientificResearchConduct')
            ->name('update');
        Route::delete('{scientificResearchConduct}', [ScientificResearchConductController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_CONDUCT_DELETE)
            ->whereNumber('scientificResearchConduct')
            ->name('delete');
    });
    Route::prefix('state-grant-fund')->name('state_grant_fund.')->group(function () {
        Route::get('', [StateGrantFundController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::STATE_GRANT_FUND_LIST)
            ->name('index');
        Route::get('create', [StateGrantFundController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::STATE_GRANT_FUND_CREATE)
            ->name('create');
        Route::get('{stateGrantFund}', [StateGrantFundController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::STATE_GRANT_FUND_EDIT)
            ->whereNumber('stateGrantFund')
            ->name('edit');
        Route::post('', [StateGrantFundController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::STATE_GRANT_FUND_CREATE)
            ->name('store');
        Route::put('{stateGrantFund}', [StateGrantFundController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::STATE_GRANT_FUND_EDIT)
            ->whereNumber('stateGrantFund')
            ->name('update');
        Route::delete('{stateGrantFund}', [StateGrantFundController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::STATE_GRANT_FUND_DELETE)
            ->whereNumber('stateGrantFund')
            ->name('delete');
    });
    Route::prefix('faculty')->name('faculty.')->group(function () {
        Route::get('', [FacultyController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::FACULTY_LIST)
            ->name('index');
        Route::get('create', [FacultyController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::FACULTY_CREATE)
            ->name('create');
        Route::get('{faculty}', [FacultyController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::FACULTY_EDIT)
            ->whereNumber('faculty')
            ->name('edit');
        Route::post('', [FacultyController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::FACULTY_CREATE)
            ->name('store');
        Route::put('{faculty}', [FacultyController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::FACULTY_EDIT)
            ->whereNumber('faculty')
            ->name('update');
        Route::delete('{faculty}', [FacultyController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::FACULTY_DELETE)
            ->whereNumber('faculty')
            ->name('delete');
    });
    Route::prefix('department')->name('department.')->group(function () {
        Route::get('', [DepartmentController::class, 'index'])
            ->can('can:' . PermissionsConstant::DEPARTMENT_LIST)
            ->name('index');
        Route::get('create', [DepartmentController::class, 'create'])
            ->can('can:' . PermissionsConstant::DEPARTMENT_CREATE)
            ->name('create');
        Route::post('', [DepartmentController::class, 'store'])
            ->can('can:' . PermissionsConstant::DEPARTMENT_CREATE)
            ->name('store');
        Route::get('{department}', [DepartmentController::class, 'edit'])
            ->can('can:' . PermissionsConstant::DEPARTMENT_EDIT)
            ->whereNumber('department')
            ->name('edit');
        Route::put('{department}', [DepartmentController::class, 'update'])
            ->can('can:' . PermissionsConstant::DEPARTMENT_EDIT)
            ->whereNumber('department')
            ->name('update');
        Route::delete('{department}', [DepartmentController::class, 'destroy'])
            ->can('can:' . PermissionsConstant::DEPARTMENT_DELETE)
            ->whereNumber('department')
            ->name('delete');
    });
    Route::get('excel-export', ExcelExportController::class)->middleware('can:' . PermissionsConstant::EXPORT_EXCEL)->name('excel_export');
    Route::prefix('article-citation')->name('article_citation.')->group(function () {
        Route::get('', [ScientificArticleCitationController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_LIST)
            ->name('index');
        Route::get('not-confirmed', [ScientificArticleCitationController::class, 'notConfirmed'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_CONFIRM)
            ->name('not_confirmed');
        Route::get('create', [ScientificArticleCitationController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_CREATE)
            ->name('create');
        Route::post('', [ScientificArticleCitationController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_CREATE)
            ->name('store');
        Route::get('edit/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_EDIT)
            ->whereNumber('scientificArticleCitation')
            ->name('edit');
        Route::put('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_EDIT)
            ->whereNumber('scientificArticleCitation')
            ->name('update');
        Route::post('confirm/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'confirm'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_CONFIRM)
            ->whereNumber('scientificArticleCitation')
            ->name('confirm');
        Route::delete('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_DELETE)
            ->whereNumber('scientificArticleCitation')
            ->name('delete');
        Route::delete('delete/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'forceDestroy'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CITATION_DELETE)
            ->whereNumber('scientificArticleCitation')
            ->name('force_delete');
    });
    Route::prefix('scientific-article')->name('scientific_article.')->group(function () {
        Route::get('', [ScientificArticleController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_LIST)
            ->name('index');
        Route::get('not-confirmed', [ScientificArticleController::class, 'getNotConfirmedArticlesList'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CONFIRM)
            ->name('not_confirmed');
        Route::get('create', [ScientificArticleController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CREATE)
            ->name('create');
        Route::get('{scientificArticle}', [ScientificArticleController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_EDIT)
            ->whereNumber('scientificArticle')
            ->name('edit');
        Route::post('', [ScientificArticleController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CREATE)
            ->name('store');
        Route::post('confirm/{scientificArticle}', [ScientificArticleController::class, 'confirm'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_CONFIRM)
            ->whereNumber('scientificArticle')
            ->name('confirm');
        Route::put('{scientificArticle}', [ScientificArticleController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_EDIT)
            ->whereNumber('scientificArticle')
            ->name('update');
        Route::delete('{scientificArticle}', [ScientificArticleController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_DELETE)
            ->whereNumber('scientificArticle')
            ->name('delete');
        Route::delete('destroy/{scientificArticle}', [ScientificArticleController::class, 'forceDestroy'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_ARTICLE_DELETE)
            ->whereNumber('scientificArticle')
            ->name('force_delete');
    });
    Route::prefix('oak-scientific-article')->name('oak_scientific_article.')->group(function () {
        Route::get('', [OakScientificArticleController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_LIST)
            ->name('index');
        Route::get('not-confirmed', [OakScientificArticleController::class, 'getNotConfirmedArticlesList'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_CONFIRM)
            ->name('not_confirmed');
        Route::get('create', [OakScientificArticleController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_CREATE)
            ->name('create');
        Route::get('{oakScientificArticle}', [OakScientificArticleController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_EDIT)
            ->whereNumber('oakScientificArticle')
            ->name('edit');
        Route::post('', [OakScientificArticleController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_CREATE)
            ->name('store');
        Route::post('confirm/{oakScientificArticle}', [OakScientificArticleController::class, 'confirm'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_CONFIRM)
            ->whereNumber('oakScientificArticle')
            ->name('confirm');
        Route::put('{oakScientificArticle}', [OakScientificArticleController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_EDIT)
            ->whereNumber('oakScientificArticle')
            ->name('update');
        Route::delete('{oakScientificArticle}', [OakScientificArticleController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_DELETE)
            ->whereNumber('oakScientificArticle')
            ->name('delete');
        Route::delete('destroy/{oakScientificArticle}', [OakScientificArticleController::class, 'forceDestroy'])
            ->middleware('can:' . PermissionsConstant::OAK_SCIENTIFIC_ARTICLE_DELETE)
            ->whereNumber('oakScientificArticle')
            ->name('force_delete');
    });
    Route::prefix('scientific-research-effectiveness')->name('scientific_research_effectiveness.')->group(function () {
        Route::get('', [ScientificResearchEffectivenessController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_LIST)
            ->name('index');
        Route::get('not-confirmed', [ScientificResearchEffectivenessController::class, 'getNotConfirmedArticlesList'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM)
            ->name('not_confirmed');
        Route::get('create', [ScientificResearchEffectivenessController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE)
            ->name('create');
        Route::get('{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT)
            ->whereNumber('scientificResearchEffectiveness')
            ->name('edit');
        Route::post('', [ScientificResearchEffectivenessController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CREATE)
            ->name('store');
        Route::put('{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_EDIT)
            ->whereNumber('scientificResearchEffectiveness')
            ->name('update');
        Route::post('confirm/{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'confirm'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_CONFIRM)
            ->whereNumber('scientificResearchEffectiveness')
            ->name('confirm');
        Route::delete('{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::SCIENTIFIC_RESEARCH_EFFECTIVENESS_DELETE)
            ->whereNumber('scientificResearchEffectiveness')
            ->name('delete');
    });
    Route::prefix('obtained-industrial-sample-patent')->name('obtained_industrial_sample_patent.')->group(function () {
        Route::get('', [ObtainedIndustrialSamplePatentController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_LIST)
            ->name('index');
        Route::get('not-confirmed', [ObtainedIndustrialSamplePatentController::class, 'getNotConfirmedArticlesList'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CONFIRM)
            ->name('not_confirmed');
        Route::get('create', [ObtainedIndustrialSamplePatentController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE)
            ->name('create');
        Route::post('', [ObtainedIndustrialSamplePatentController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CREATE)
            ->name('store');
        Route::post('confirm/{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'confirm'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_CONFIRM)
            ->whereNumber('obtainedIndustrialSamplePatent')
            ->name('confirm');
        Route::get('{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_EDIT)
            ->whereNumber('obtainedIndustrialSamplePatent')
            ->name('edit');
        Route::put('{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_EDIT)
            ->whereNumber('obtainedIndustrialSamplePatent')
            ->name('update');
        Route::delete('{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::OBTAINED_INDUSTRIAL_SAMPLE_PATENT_DELETE)
            ->whereNumber('obtainedIndustrialSamplePatent')
            ->name('delete');
    });
    Route::prefix('copyright-protected-various-material-information')->name('copyright_protected_various_material_information.')->group(function () {
        Route::get('', [CopyrightProtectedVariousMaterialInformationController::class, 'index'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_LIST)
            ->name('index');
        Route::get('not-confirmed', [CopyrightProtectedVariousMaterialInformationController::class, 'getNotConfirmedArticlesList'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CONFIRM)
            ->name('not_confirmed');
        Route::get('create', [CopyrightProtectedVariousMaterialInformationController::class, 'create'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE)
            ->name('create');
        Route::get('{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'edit'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_EDIT)
            ->whereNumber('information')
            ->name('edit');
        Route::post('', [CopyrightProtectedVariousMaterialInformationController::class, 'store'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CREATE)
            ->name('store');
        Route::post('confirm/{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'confirm'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_CONFIRM)
            ->whereNumber('information')
            ->name('confirm');
        Route::put('{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'update'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_EDIT)
            ->whereNumber('information')
            ->name('update');
        Route::delete('{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'destroy'])
            ->middleware('can:' . PermissionsConstant::COPYRIGHT_PROTECTED_VARIOUS_MATERIAL_INFORMATION_DELETE)
            ->whereNumber('information')
            ->name('delete');
    });
    Route::prefix('report')->name('report.')->middleware('can:' . PermissionsConstant::SEE_REPORTS)->group(function () {
        Route::get('get-articles-report', [ReportsController::class, 'scientificArticles'])
            ->name('scientificArticles');
        Route::get('get-articles-report-by-faculty', [ReportsController::class, 'scientificArticlesByFaculty'])
            ->name('scientificArticlesByFaculty');
        Route::get('get-article-citations-report', [ReportsController::class, 'scientificArticleCitations'])
            ->name('scientificArticleCitations');
        Route::get('get-article-citations-report-by-faculty', [ReportsController::class, 'scientificArticleCitationsByFaculty'])
            ->name('scientificArticleCitationsByFaculty');
        Route::get('get-oak-article-report', [ReportsController::class, 'oakScientificArticles'])
            ->name('oakScientificArticleCitations');
        Route::get('get-oak-article-report-by-faculty', [ReportsController::class, 'oakScientificArticlesByFaculty'])
            ->name('oakScientificArticleCitationsByFaculty');
        Route::get('get-scientific-research-effectiveness', [ReportsController::class, 'scientificResearchEffectiveness'])
            ->name('scientificResearchEffectiveness');
        Route::get('get-scientific-research-effectiveness-by-faculty', [ReportsController::class, 'scientificResearchEffectivenessByFaculty'])
            ->name('scientificResearchEffectivenessByFaculty');
        Route::get('get-copyright-protected-various-information', [ReportsController::class, 'copyrightProtectedVariousInformation'])
            ->name('copyrightProtectedVariousInformation');
        Route::get('get-copyright-protected-various-information-by-faculty', [ReportsController::class, 'copyrightProtectedVariousInformationByFaculty'])
            ->name('copyrightProtectedVariousInformationByFaculty');
        Route::get('get-obtained-industrial-sample-patent', [ReportsController::class, 'obtainedIndustrialSamplePatent'])
            ->name('obtainedIndustrialSamplePatent');
        Route::get('get-obtained-industrial-sample-patent-by-faculty', [ReportsController::class, 'obtainedIndustrialSamplePatentByFaculty'])
            ->name('obtainedIndustrialSamplePatentByFaculty');
        Route::get('get-degree-report', [[ReportsController::class, 'getDegreeReport']])
            ->name('degreeReport');
    });
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');








//Auth::routes();
