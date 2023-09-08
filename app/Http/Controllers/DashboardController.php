<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(): View
    {
        $sellerAdmin = Auth()->user()->is_admin;
        $sellers = DB::table('sellers')->where('is_admin', '=', false)->paginate(10);

        return view('dashboard', ['sellers' => $sellers, 'sellerAdmin' => $sellerAdmin]);
    }
}
