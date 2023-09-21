<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Http\Requests\SellerRequest;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::all();


        return SellerResource::collection($sellers);
    }

    public function store(SellerRequest $request)
    {
        $data = $request->all();


        if (!$data['password']) {
            $data['password'] = Hash::make('trocar123');
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $seller = Seller::create($data);

        //retorna apenas os dados que deve retornar ao usar o resource criado
        return new SellerResource($seller);
    }
}
