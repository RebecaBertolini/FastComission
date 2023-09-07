<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class SellerController extends Controller
{
    public function create(): View
    {
        return view('./seller/create');
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Seller::class],
        ]);

        $seller = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($seller)
    {
        // Busque o vendedor com base no ID
        $seller = Seller::with('sales')->find($seller);

        return view('seller.edit', compact('seller'));
    }

    public function update($seller, Request $request)
    {
        $seller = Seller::findOrFail($seller);

        $data = $request->all();

        $validatedData = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('sellers')->ignore($seller->id)],
        ]);

        $seller->update($validatedData);

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
