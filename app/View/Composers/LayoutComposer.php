<?php

namespace App\View\Composers;

use App\Constants\PermissionsConstant;
use Illuminate\View\View;

class LayoutComposer
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
            'excel' => PermissionsConstant::EXPORT_EXCEL
        ]);
    }
}
