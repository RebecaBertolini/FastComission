<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $salePriceString = $request->input('sale_price');

        $salePrice = floatval($salePriceString);

        Sale::create([
            'seller_id' => $request->input('seller_id'),
            'sale_price' => $request->input('sale_price'),
            'sale_date' => $request->sale_date,
            'comission' => 8.5,
        ]);

        return redirect()->route('seller.edit', ['id' => $request->input('seller_id')]);
    }
}
