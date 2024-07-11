<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\ElimStatistics;

class ElimStatisticsController extends BaseController
{
    public function __construct(ElimStatistics $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}