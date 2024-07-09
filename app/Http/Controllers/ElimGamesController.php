<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\ElimGames;

class ElimGamesController extends BaseController
{
    public function __construct(ElimGames $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */
}