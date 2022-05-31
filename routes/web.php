<?php

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

    Route::middleware('is_admin')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::get('search', [UserController::class, 'search'])->name('search');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('', [UserController::class, 'store'])->name('store');
            Route::get('edit/{user:username}', [UserController::class, 'edit'])->whereAlphaNumeric('user')->name('edit');
            Route::put('{user:username}', [UserController::class, 'update'])->whereAlphaNumeric('user')->name('update');
            Route::delete('{user:username}', [UserController::class, 'destroy'])->where('user', '[a-zA-Z0-9\.]+')->name('delete');
        });
        Route::prefix('phd-doctors')->name('phd_doctors.')->group(function () {
            Route::get('', [PhdDoctorController::class, 'index'])->name('index');
            Route::get('create', [PhdDoctorController::class, 'create'])->name('create');
            Route::post('', [PhdDoctorController::class, 'store'])->name('store');
            Route::get('edit/{phdDoctor}', [PhdDoctorController::class, 'edit'])->whereNumber('phdDoctor')->name('edit');
            Route::put('{phdDoctor}', [PhdDoctorController::class, 'update'])->whereNumber('phdDoctor')->name('update');
            Route::delete('{phdDoctor}', [PhdDoctorController::class, 'destroy'])->whereNumber('phdDoctor')->name('delete');
        });
        Route::prefix('dsc-doctors')->name('dsc_doctors.')->group(function () {
            Route::get('', [DscDoctorController::class, 'index'])->name('index');
            Route::get('create', [DscDoctorController::class, 'create'])->name('create');
            Route::post('', [DscDoctorController::class, 'store'])->name('store');
            Route::get('edit/{dScDoctor}', [DscDoctorController::class, 'edit'])->whereNumber('dScDoctor')->name('edit');
            Route::put('{dScDoctor}', [DscDoctorController::class, 'update'])->whereNumber('dScDoctor')->name('update');
            Route::delete('{dScDoctor}', [DscDoctorController::class, 'destroy'])->whereNumber('dScDoctor')->name('delete');
        });
        Route::prefix('grant-fund-order')->name('grant_fund_order.')->group(function () {
            Route::get('', [GrantFundOrderController::class, 'index'])->name('index');
            Route::get('create', [GrantFundOrderController::class, 'create'])->name('create');
            Route::get('{grantFundOrder}', [GrantFundOrderController::class, 'edit'])->whereNumber('grantFundOrder')->name('edit');
            Route::post('', [GrantFundOrderController::class, 'store'])->name('store');
            Route::put('{grantFundOrder}', [GrantFundOrderController::class, 'update'])->whereNumber('grantFundOrder')->name('update');
            Route::delete('{grantFundOrder}', [GrantFundOrderController::class, 'destroy'])->whereNumber('grantFundOrder')->name('delete');
        });
        Route::prefix('scientific-research-conduct')->name('scientific_research_conduct.')->group(function () {
            Route::get('', [ScientificResearchConductController::class, 'index'])->name('index');
            Route::get('create', [ScientificResearchConductController::class, 'create'])->name('create');
            Route::get('{scientificResearchConduct}', [ScientificResearchConductController::class, 'edit'])->whereNumber('scientificResearchConduct')->name('edit');
            Route::post('', [ScientificResearchConductController::class, 'store'])->name('store');
            Route::put('{scientificResearchConduct}', [ScientificResearchConductController::class, 'update'])->whereNumber('scientificResearchConduct')->name('update');
            Route::delete('{scientificResearchConduct}', [ScientificResearchConductController::class, 'destroy'])->whereNumber('scientificResearchConduct')->name('delete');
        });
        Route::prefix('state-grant-fund')->name('state_grant_fund.')->group(function () {
            Route::get('', [StateGrantFundController::class, 'index'])->name('index');
            Route::get('create', [StateGrantFundController::class, 'create'])->name('create');
            Route::get('{stateGrantFund}', [StateGrantFundController::class, 'edit'])->whereNumber('stateGrantFund')->name('edit');
            Route::post('', [StateGrantFundController::class, 'store'])->name('store');
            Route::put('{stateGrantFund}', [StateGrantFundController::class, 'update'])->whereNumber('stateGrantFund')->name('update');
            Route::delete('{stateGrantFund}', [StateGrantFundController::class, 'destroy'])->whereNumber('stateGrantFund')->name('delete');
        });
        Route::prefix('faculty')->name('faculty.')->group(function () {
            Route::get('', [FacultyController::class, 'index'])->name('index');
            Route::get('create', [FacultyController::class, 'create'])->name('create');
            Route::get('{faculty}', [FacultyController::class, 'edit'])->whereNumber('faculty')->name('edit');
            Route::post('', [FacultyController::class, 'store'])->name('store');
            Route::put('{faculty}', [FacultyController::class, 'update'])->whereNumber('faculty')->name('update');
            Route::delete('{faculty}', [FacultyController::class, 'destroy'])->whereNumber('faculty')->name('delete');
        });
        Route::prefix('department')->name('department.')->group(function () {
            Route::get('', [DepartmentController::class, 'index'])->name('index');
            Route::get('create', [DepartmentController::class, 'create'])->name('create');
            Route::post('', [DepartmentController::class, 'store'])->name('store');
            Route::get('{department}', [DepartmentController::class, 'edit'])->whereNumber('department')->name('edit');
            Route::put('{department}', [DepartmentController::class, 'update'])->whereNumber('department')->name('update');
            Route::delete('{department}', [DepartmentController::class, 'destroy'])->whereNumber('department')->name('delete');
        });
    });

    Route::prefix('article-citation')->name('article_citation.')->group(function () {
        Route::get('', [ScientificArticleCitationController::class, 'index'])->name('index');
        Route::get('not-confirmed', [ScientificArticleCitationController::class, 'notConfirmed'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [ScientificArticleCitationController::class, 'create'])->name('create');
        Route::post('', [ScientificArticleCitationController::class, 'store'])->name('store');
        Route::get('edit/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'edit'])
            ->whereNumber('scientificArticleCitation')
            ->name('edit');
        Route::put('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'update'])
            ->whereNumber('scientificArticleCitation')
            ->name('update');
        Route::post('confirm/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('scientificArticleCitation')
            ->name('confirm');
        Route::delete('{scientificArticleCitation}', [ScientificArticleCitationController::class, 'destroy'])
            ->whereNumber('scientificArticleCitation')
            ->name('delete');
        Route::delete('delete/{scientificArticleCitation}', [ScientificArticleCitationController::class, 'forceDestroy'])
            ->whereNumber('scientificArticleCitation')
            ->name('force_delete');
    });

    Route::prefix('scientific-article')->name('scientific_article.')->group(function () {
        Route::get('', [ScientificArticleController::class, 'index'])->name('index');
        Route::get('not-confirmed', [ScientificArticleController::class, 'getNotConfirmedArticlesList'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [ScientificArticleController::class, 'create'])->name('create');
        Route::get('{scientificArticle}', [ScientificArticleController::class, 'edit'])->whereNumber('scientificArticle')->name('edit');
        Route::post('', [ScientificArticleController::class, 'store'])->name('store');
        Route::post('confirm/{scientificArticle}', [ScientificArticleController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('scientificArticle')
            ->name('confirm');
        Route::put('{scientificArticle}', [ScientificArticleController::class, 'update'])->whereNumber('scientificArticle')->name('update');
        Route::delete('{scientificArticle}', [ScientificArticleController::class, 'destroy'])->whereNumber('scientificArticle')->name('delete');
        Route::delete('destroy/{scientificArticle}', [ScientificArticleController::class, 'forceDestroy'])->whereNumber('scientificArticle')->name('force_delete');
        Route::post('attach/{scientificArticle}', [ScientificArticleController::class, 'attach'])->whereNumber('scientificArticle')->name('attach');
    });

    Route::prefix('oak-scientific-article')->name('oak_scientific_article.')->group(function () {
        Route::get('', [OakScientificArticleController::class, 'index'])->name('index');
        Route::get('not-confirmed', [OakScientificArticleController::class, 'getNotConfirmedArticlesList'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [OakScientificArticleController::class, 'create'])->name('create');
        Route::get('{oakScientificArticle}', [OakScientificArticleController::class, 'edit'])->whereNumber('oakScientificArticle')->name('edit');
        Route::post('', [OakScientificArticleController::class, 'store'])->name('store');
        Route::post('confirm/{oakScientificArticle}', [OakScientificArticleController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('oakScientificArticle')
            ->name('confirm');
        Route::put('{oakScientificArticle}', [OakScientificArticleController::class, 'update'])->whereNumber('oakScientificArticle')->name('update');
        Route::delete('{oakScientificArticle}', [OakScientificArticleController::class, 'destroy'])->whereNumber('oakScientificArticle')->name('delete');
        Route::delete('destroy/{oakScientificArticle}', [OakScientificArticleController::class, 'forceDestroy'])->whereNumber('oakScientificArticle')->name('force_delete');
        Route::post('attach/{oakScientificArticle}', [OakScientificArticleController::class, 'attach'])->whereNumber('oakScientificArticle')->name('attach');
    });

    Route::prefix('scientific-research-effectiveness')->name('scientific_research_effectiveness.')->group(function () {
        Route::get('', [ScientificResearchEffectivenessController::class, 'index'])->name('index');
        Route::get('not-confirmed', [ScientificResearchEffectivenessController::class, 'getNotConfirmedArticlesList'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [ScientificResearchEffectivenessController::class, 'create'])->name('create');
        Route::get('{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'edit'])->whereNumber('scientificResearchEffectiveness')->name('edit');
        Route::post('', [ScientificResearchEffectivenessController::class, 'store'])->name('store');
        Route::put('{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'update'])->whereNumber('scientificResearchEffectiveness')->name('update');
        Route::post('confirm/{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('scientificResearchEffectiveness')
            ->name('confirm');
        Route::delete('{scientificResearchEffectiveness}', [ScientificResearchEffectivenessController::class, 'destroy'])->whereNumber('scientificResearchEffectiveness')->name('delete');
    });

    Route::prefix('obtained-industrial-sample-patent')->name('obtained_industrial_sample_patent.')->group(function () {
        Route::get('', [ObtainedIndustrialSamplePatentController::class, 'index'])->name('index');
        Route::get('not-confirmed', [ObtainedIndustrialSamplePatentController::class, 'getNotConfirmedArticlesList'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [ObtainedIndustrialSamplePatentController::class, 'create'])->name('create');
        Route::post('', [ObtainedIndustrialSamplePatentController::class, 'store'])->name('store');
        Route::post('confirm/{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('obtainedIndustrialSamplePatent')
            ->name('confirm');
        Route::get('{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'edit'])->whereNumber('obtainedIndustrialSamplePatent')->name('edit');
        Route::put('{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'update'])->whereNumber('obtainedIndustrialSamplePatent')->name('update');
        Route::delete('{obtainedIndustrialSamplePatent}', [ObtainedIndustrialSamplePatentController::class, 'destroy'])->whereNumber('obtainedIndustrialSamplePatent')->name('delete');
    });

    Route::prefix('copyright-protected-various-material-information')->name('copyright_protected_various_material_information.')->group(function () {
        Route::get('', [CopyrightProtectedVariousMaterialInformationController::class, 'index'])->name('index');
        Route::get('not-confirmed', [CopyrightProtectedVariousMaterialInformationController::class, 'getNotConfirmedArticlesList'])
            ->middleware('is_admin')
            ->name('not_confirmed');
        Route::get('create', [CopyrightProtectedVariousMaterialInformationController::class, 'create'])->name('create');
        Route::get('{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'edit'])->whereNumber('information')->name('edit');
        Route::post('', [CopyrightProtectedVariousMaterialInformationController::class, 'store'])->name('store');
        Route::post('confirm/{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'confirm'])
            ->middleware('is_admin')
            ->whereNumber('information')
            ->name('confirm');
        Route::put('{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'update'])->whereNumber('information')->name('update');
        Route::delete('{information}', [CopyrightProtectedVariousMaterialInformationController::class, 'destroy'])->whereNumber('information')->name('delete');
    });

    Route::prefix('report')->name('report.')->group(function () {
        Route::get('get-articles-report', [ReportsController::class, 'scientificArticles'])->name('scientificArticles');
        Route::get('get-articles-report-by-faculty', [ReportsController::class, 'scientificArticlesByFaculty'])->name('scientificArticlesByFaculty');
        Route::get('get-article-citations-report', [ReportsController::class, 'scientificArticleCitations'])->name('scientificArticleCitations');
        Route::get('get-article-citations-report-by-faculty', [ReportsController::class, 'scientificArticleCitationsByFaculty'])->name('scientificArticleCitationsByFaculty');
        Route::get('get-oak-article-report', [ReportsController::class, 'oakScientificArticles'])->name('oakScientificArticleCitations');
        Route::get('get-oak-article-report-by-faculty', [ReportsController::class, 'oakScientificArticlesByFaculty'])->name('oakScientificArticleCitationsByFaculty');
        Route::get('get-scientific-research-effectiveness', [ReportsController::class, 'scientificResearchEffectiveness'])->name('scientificResearchEffectiveness');
        Route::get('get-scientific-research-effectiveness-by-faculty', [ReportsController::class, 'scientificResearchEffectivenessByFaculty'])->name('scientificResearchEffectivenessByFaculty');
        Route::get('get-copyright-protected-various-information', [ReportsController::class, 'copyrightProtectedVariousInformation'])->name('copyrightProtectedVariousInformation');
        Route::get('get-copyright-protected-various-information-by-faculty', [ReportsController::class, 'copyrightProtectedVariousInformationByFaculty'])->name('copyrightProtectedVariousInformationByFaculty');
        Route::get('get-obtained-industrial-sample-patent', [ReportsController::class, 'obtainedIndustrialSamplePatent'])->name('obtainedIndustrialSamplePatent');
        Route::get('get-obtained-industrial-sample-patent-by-faculty', [ReportsController::class, 'obtainedIndustrialSamplePatentByFaculty'])->name('obtainedIndustrialSamplePatentByFaculty');
        Route::get('get-degree-report', [[ReportsController::class, 'getDegreeReport']])->name('degreeReport');
    });
});


Auth::routes();
