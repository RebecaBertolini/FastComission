<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function index() : View
    {
        $sellers = DB::table('sellers')->paginate(10);

        return view('dashboard', ['sellers' => $sellers]);
    }

}
