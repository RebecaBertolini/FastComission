<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Seller;

class SaleController extends Controller
{
    public function store(Request $request)
    {

        $sellerAdmin = Auth()->user()->is_admin;

        $sellerCommission = Seller::where('id', $request->seller_id)->value('commission');

        $sellerCommission = floatval($sellerCommission);

        Sale::create([
            'seller_id' => $request->input('seller_id'),
            'sale_price' => $request->input('sale_price'),
            'sale_date' => $request->sale_date,
            'commission' => $sellerCommission,
        ]);

        if ($sellerAdmin) {
            return redirect()->route('seller.edit', ['id' => $request->input('seller_id')]);
        } else {
            return redirect()->back();
        }
    }

    public function destroy($sale)
    {

        $sale = Sale::findOrFail($sale);

        $sale->delete();

        return redirect()->back();
    }
}
