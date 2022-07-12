<?php

use App\Models\ServiceModel;


if (!function_exists('servicecategory')) {
    function servicecategory()
    {
        return ServiceModel::where('status', 1)->get();
    }
}
