<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function download() {
        return view('dashboard/download');
    }

    public function otherpages() {
        return view('dashboard/extras');
    }
}
