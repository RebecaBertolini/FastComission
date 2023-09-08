<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {

            $userAdmin = Auth()->user()->is_admin;

            if ($userAdmin) {

                return redirect('/dashboard');
            } else {

                $seller = Auth()->user()->id;

                $seller = Seller::with('sales')->find($seller);

                $salesWithCommissionArray = [];
                $totalCommission = 0;

                foreach ($seller->sales as $sale) {

                    //calculates the total Seller commission
                    $commission = $sale->sale_price * ($sale->commission / 100);
                    $totalCommission += $commission;

                    $formatedSaleDate = \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y');

                    //Create new array with sales commission
                    $saleWithCommission = [
                        'id' => $sale->id,
                        'sale_date' => $formatedSaleDate,
                        'sale_price' => $sale->sale_price,
                        'commission' => $sale->commission,
                        'value_commission' => $commission
                    ];

                    $salesWithCommissionArray[] = $saleWithCommission;
                }


                $totalCommission = number_format($totalCommission, 2, ',', '');

                return view('home', compact('seller', 'totalCommission', 'salesWithCommissionArray'));
            }
        }
    }
}
