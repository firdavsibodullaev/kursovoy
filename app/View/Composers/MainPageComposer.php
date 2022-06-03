<?php

namespace App\View\Composers;

use App\Constants\PermissionsConstant;
use Illuminate\View\View;

class MainPageComposer
{

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissions', [
            'reports' => PermissionsConstant::SEE_REPORTS
        ]);
    }
}
