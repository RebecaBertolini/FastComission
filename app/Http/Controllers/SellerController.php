<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SellerRequest;


class SellerController extends Controller
{
    public function create(): View
    {
        return view('./seller/create');
    }

    public function store(SellerRequest $request): RedirectResponse
    {

        Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('trocar123'),
            'commission' => $request->commission,
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($seller)
    {

        // Get Seller by ID with sales
        $seller = Seller::with('sales')->find($seller);

        //Create new array with sales commission



        $salesWithCommissionArray = [];
        $totalCommission = 0;

        foreach ($seller->sales as $sale) {

            //calculates the total Seller commission
            $commission = $sale->sale_price * ($sale->commission / 100);
            $totalCommission += $commission;

            $formatedSaleDate = \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y');
            $commission = number_format($commission, 2, ',', '');
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


        return view('seller.edit', compact('seller', 'totalCommission', 'salesWithCommissionArray'));
    }

    public function update($seller, SellerRequest $request)
    {
        $seller = Seller::findOrFail($seller);

        $newSeller = [
            'name' => $request->name,
            'email' => $request->email,
            'commission' => $request->commission,
        ];

        $seller->update($newSeller);

        return redirect()->route('seller.edit', ['id' => $seller->id]);
    }

    public function destroy($seller)
    {
        $seller = Seller::find($seller);

        if (!$seller) {
            dd($seller);
        }

        $seller->delete();

        return redirect('dashboard');
    }
}
