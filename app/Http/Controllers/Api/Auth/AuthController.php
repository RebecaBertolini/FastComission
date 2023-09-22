<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        //verify if seller is in db
        $seller = Seller::where('email', $request->email)->first();

        //if dont find user or the request password dont match with que db password
        if (!$seller || !Hash::check($request->password, $seller->password)) {
            throw ValidationException::withMessages([
                'message' => ['As credenciais estão incorretas.']
            ]);
        }

        //create token
        $token = $seller->createToken('Seller Token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
}
