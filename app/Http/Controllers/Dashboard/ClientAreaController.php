<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAreaController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('dashboard/client-area');
    }
}
