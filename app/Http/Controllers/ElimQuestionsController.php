<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\ElimQuestions;

class ElimQuestionsController extends BaseController
{
    public function __construct(ElimQuestions $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}