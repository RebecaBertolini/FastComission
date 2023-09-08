<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function index(): View
    {
        $sellerAdmin = Auth()->user()->is_admin;

        $sellers = DB::table('sellers')->where('is_admin', '=', 0)->latest()->paginate(5);

        return view('dashboard', ['sellers' => $sellers, 'sellerAdmin' => $sellerAdmin]);
    }
}
