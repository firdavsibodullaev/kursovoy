<?php

namespace App\View\Composers;

use App\Models\Faculty;
use Illuminate\View\View;

class StatisticsPageComposer
{

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('faculties', Faculty::query()->get(['id', 'full_name']));
    }
}
