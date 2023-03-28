<?php

namespace App\Http\Controllers;

class ConfigController extends Controller
{
    public function clearRoute()
    {
        \Artisan::call('config:cache');
    }
}