<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class ThingsController extends BaseController
{
    public function index()
    {
        return view('things.index');
    }
}
