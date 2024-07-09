<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\ElimQuestionHistory;

class ElimQuestionHistoryController extends BaseController
{
    public function __construct(ElimQuestionHistory $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}