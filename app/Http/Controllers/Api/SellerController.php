<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
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


        //retrurn specific data about seller
        $newSeller = new SellerResource($seller);

        //create the response sending the seller and the status code
        $response = response()->json($newSeller, 201);

        //send the location for API REST
        $response->header('Location', '/api/sellers/' . $seller->id);

        return $response;
    }

    public function update(SellerRequest $request, $id)
    {

        $seller = Seller::find($id);

        $newSeller = [
            'name' => $request->name,
            'email' => $request->email,
            'commission' => $request->commission,
        ];

        $seller->update($newSeller);

        return  response()->json([], 204);
    }

    public function destroy($id)
    {

        $seller = Seller::find($id);

        $seller->delete();

        return response()->json([
            "message" => "Deletado com sucesso"
        ], 204);
    }
}
